<?php

namespace Chocala\Util;

/**
 * Description of NumberUtil
 *
 * @author ypra
 * Date: 28/03/2015
 * Time: 06:23 PM
 */
class NumberUtil
{
    //TODO: implements Number functions

    public static function format($number, $dec = 2)
    {
        if (is_numeric($number)) {
            return number_format($number, $dec);
        }
        return null;
    }

    public static function value($value)
    {
        if (is_numeric($value * 1)) {
            $value = $value . '';
            return $value != '' ? str_replace(',', '', $value) * 1 : 0;
        }
        return 0;
    }
}
