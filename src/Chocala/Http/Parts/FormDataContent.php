<?php

namespace Chocala\Http\Parts;

use Chocala\Base\IllegalArgumentException;
use InvalidArgumentException;

class FormDataContent implements MessageContentInterface
{

    /**
     * @var MessageContent
     */
    private MessageContent $messageContent;

    public function __construct()
    {
        $get_arguments = func_get_args();
        $number_of_arguments = func_num_args();
        if (method_exists($this, $method_name = '__construct' . $number_of_arguments)) {
            call_user_func_array([$this, $method_name], $get_arguments);
        } else {
            throw new InvalidArgumentException('Invalid number of arguments to create object ' . __CLASS__);
        }
    }

    private function __constructor(MessageContent $messageContent)
    {
        $this->messageContent = $messageContent;
    }


    /**
     * @return void
     * @throws InvalidArgumentException
     */
    private function __construct0()
    {
        $postFormDataContent = new PostFormDataContent();
        $this->__constructor($postFormDataContent);
    }

    /**
     * @param $contentType
     * @param $rawData
     * @return void
     * @throws IllegalArgumentException
     */
    private function __construct2($contentType, $rawData)
    {
        if (!is_string($contentType)) {
            throw new IllegalArgumentException('Parameter \'contentType\' should be a string to create a RawFormDataContent object');
        }
        if (!is_string($rawData)) {
            throw new IllegalArgumentException('Parameter \'rawData\' should be a string to create a RawFormDataContent object');
        }
        $rawFormDataContent = new RawFormDataContent($contentType, $rawData);
        $this->__constructor($rawFormDataContent);
    }

    /**
     * @return string
     */
    public function type(): string
    {
        return $this->messageContent->type();
    }

    /**
     * @return mixed
     */
    public function data()
    {
        return $this->messageContent->data();
    }

}