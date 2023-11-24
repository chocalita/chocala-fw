<?php

namespace Chocala\Util;

/**
 * Description of SpecialsStrings
 *
 * @author ypra
 */
class SpecialStrings
{

    /**
     * Set of lowercase
     */
    const LOWERCASE_SET = 'abcdefghijklmnopqrstuvwxyz';

    /**
     * Set of uppercase
     */
    const UPPERCASE_SET = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

    /**
     * Set of lowercase asn uppercaser letters from a generated password
     */
    const PASSWORD_SET =
            'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz23456789';

    /**
     *
     * @return array
     */
    public static function lowercaseArray()
    {
        return str_split(utf8_decode(self::LOWERCASE_SET));
    }

    /**
     *
     * @return array
     */
    public static function uppercaseArray()
    {
        return str_split(utf8_decode(self::UPPERCASE_SET));
    }

    /**
     * @param int $length
     * @return string
     */
    public static function generateHash($length = 8)
    {
        $hash = '';
        $set = str_shuffle(self::PASSWORD_SET);
        for($i=0; $i<$length; $i++){
            $hash.= $set[rand(0,30)];
        }
        return $hash;
    }

    /**
     *
     * @return string
     */
    public static function generateUsername()
    {
        return rand(1100, 1299).rand(0,9).rand(0,9).rand(0,9).rand(0,9);
    }

    /**
     *
     * @param int $number
     * @param int $level
     * @return string
     */
    public static function normalizeNumber($number, $level)
    {
        $max = pow(10, $level-1);
        $normalized = '';
        while($max>$number){
            $normalized.= '0';
            $max/= 10;
        }
        $normalized.=$number;
        return $normalized;
    }

    /**
     *
     * @param string $text
     * @param bool $lowercase
     * @return string
     */
    public static function text2Url($text, $lowercase=false)
    {
        $table = array('�'=>'Dj', '�'=>'A', '�'=>'A', '�'=>'A', '�'=>'A',
            '�'=>'A', '�'=>'A', '�'=>'A', '�'=>'C', '�'=>'E', '�'=>'E',
            '�'=>'E', '�'=>'E', '�'=>'I', '�'=>'I', '�'=>'I', '�'=>'I',
            '�'=>'N', '�'=>'O', '�'=>'O', '�'=>'O', '�'=>'O', '�'=>'O',
            '�'=>'O', '�'=>'U', '�'=>'U', '�'=>'U', '�'=>'U', '�'=>'Y',
            '�'=>'B', '�'=>'Ss', '&'=>'-y-', '�'=>'a', '�'=>'a', '�'=>'a',
            '�'=>'a', '�'=>'a', '�'=>'a', '�'=>'a', '�'=>'b', '�'=>'c',
            '�'=>'e', '�'=>'e', '�'=>'e', '�'=>'e', '�'=>'i', '�'=>'i',
            '�'=>'i', '�'=>'i', '�'=>'o', '�'=>'n', '�'=>'o', '�'=>'o',
            '�'=>'o', '�'=>'o', '�'=>'o', '�'=>'o', '�'=>'u', '�'=>'u',
            '�'=>'u', '�'=>'y', '�'=>'y', '�'=>'y');
        $newText= strtr($text, $table);
        $newText = trim($newText);
        $spacer = "-";
//        $newText = trim(ereg_replace("[^ A-Za-z0-9_]", " ", $newText));
//        $newText = ereg_replace("[ \t\n\r]+", $spacer, $newText);

        $clean_name = strtr($newText, array('Š' => 'S','Ž' => 'Z','š' => 's','ž' => 'z','Ÿ' => 'Y','À' => 'A','Á' => 'A','Â' => 'A','Ã' => 'A','Ä' => 'A','Å' => 'A','Ç' => 'C','È' => 'E','É' => 'E','Ê' => 'E','Ë' => 'E','Ì' => 'I','Í' => 'I','Î' => 'I','Ï' => 'I','Ñ' => 'N','Ò' => 'O','Ó' => 'O','Ô' => 'O','Õ' => 'O','Ö' => 'O','Ø' => 'O','Ù' => 'U','Ú' => 'U','Û' => 'U','Ü' => 'U','Ý' => 'Y','à' => 'a','á' => 'a','â' => 'a','ã' => 'a','ä' => 'a','å' => 'a','ç' => 'c','è' => 'e','é' => 'e','ê' => 'e','ë' => 'e','ì' => 'i','í' => 'i','î' => 'i','ï' => 'i','ñ' => 'n','ò' => 'o','ó' => 'o','ô' => 'o','õ' => 'o','ö' => 'o','ø' => 'o','ù' => 'u','ú' => 'u','û' => 'u','ü' => 'u','ý' => 'y','ÿ' => 'y'));
        $clean_name = strtr($clean_name, array('Þ' => 'TH', 'þ' => 'th', 'Ð' => 'DH', 'ð' => 'dh', 'ß' => 'ss', 'Œ' => 'OE', 'œ' => 'oe', 'Æ' => 'AE', 'æ' => 'ae', 'µ' => 'u'));
        $newText = preg_replace(array('/\s/', '/\.[\.]+/', '/[^\w_\.\-]/'), array('_', '.', ''), $clean_name);

        $newText = str_replace(" ", $spacer, $newText);
//        $newText = ereg_replace("[ _]+", "-", $newText);
//        $newText = ereg_replace("[ -]+", "-", $newText);
        if($lowercase){
            $newText = strtolower($newText);
        }
        return $newText;
    }

    /**
     * 
     * @param string $text
     * @return string
     */
    public static function camelCase($text)
    {
        return str_replace(' ', '', ucwords(str_replace('_', ' ', $text)));
    }

    /**
     * 
     * @param string $text
     * @return string
     */
    public static function pascalCase($text)
    {
        return lcfirst(self::camelCase($text));
    }

    /**
     * 
     * @param string $text
     * @return string
     */
    public static function underscore($text)
    {
        //TODO: optimize underscore transformation
        return str_replace(' ', '_', $text);
    }



}