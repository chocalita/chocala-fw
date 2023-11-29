<?php

namespace Chocala\Http\Parts;

use Chocala\Base\IllegalArgumentException;
use Chocala\System\ContentType;

class RawFormDataContent extends MessageContent implements MessageContentInterface
{

    public function __construct(string $contentType, string $rawData)
    {
        $this->type = ContentType::MULTIPART_FORM_DATA;
        $this->data = $this->parseData($contentType, $rawData);
    }

    /**
     * @return array
     */
    public function data() : array
    {
        return $this->data;
    }

    /**
     * Parse method based in this strategy: https://stackoverflow.com/a/72747444
     *
     * @param string $contentType
     * @param string $rawData
     * @return array
     */
    private function parseData(string $contentType, string $rawData) : array
    {
        if (preg_match('/^multipart\/form-data; boundary=.*$/ui', $contentType) !== 1) {
            throw new IllegalArgumentException('Invalid multipart/form-data, Content-Type is not matching with the required.');
        }
        #Get boundary value
        $boundary = preg_replace('/(^multipart\/form-data; boundary=)(.*$)/ui', '$2', $contentType);
        #Exit if failed to get the input or if it's not compliant with the RFC2046
        if (trim($rawData) !== '' && preg_match('/^\s*--'.$boundary.'.*\s*--'.$boundary.'--\s*$/muis', $rawData) !== 1) {
            throw new IllegalArgumentException('Invalid multipart/form-data raw data');
        }
        #Strip ending boundary
        $rawData = preg_replace('/(^\s*--'.$boundary.'.*)(\s*--'.$boundary.'--\s*$)/muis', '$1', trim($rawData));
        #Split data into array of fields
        $rawData = preg_split('/\s*--'.$boundary.'\s*Content-Disposition: form-data;\s*/muis', $rawData, 0, PREG_SPLIT_NO_EMPTY);
        #Convert to associative array
        $parsedData = [];
        foreach ($rawData as $field) {
            $name =  preg_replace('/(name=")(?<name>[^"]+)("\s*)(?<value>.*$)/mui', '$2', $field);
            $value =  preg_replace('/(name=")(?<name>[^"]+)("\s*)(?<value>.*$)/mui', '$4', $field);
            #Check if we have multiple keys
            if (strpos($name, '[') !== false) {
            //if (str_contains($name, '[')) {
                #Explode keys into array
                $keys = explode('[', trim($name));
                $name = '';
                #Build JSON array string from keys
                foreach ($keys as $key) {
                    $name .= '{"' . rtrim($key, ']') . '":';
                }
                #Add the value itself (as string, since in this case it will always be a string) and closing brackets
                $name .= '"' . trim($value) . '"' . str_repeat('}', count($keys));
                #Convert into actual PHP array
                $array = json_decode($name, true);
                #Check if we actually got an array and did not fail
                if (!is_null($array)) {
                    #"Merge" the array into existing data. Doing recursive replace, so that new fields will be added, and in case of duplicates, only the latest will be used
                    $parsedData = array_replace_recursive($parsedData, $array);
                }
            } else {
                #Single key - simple processing
                $parsedData[trim($name)] = trim($value);
            }
        }
        #Return the raw parsed data into an array
        return $parsedData;
    }

}