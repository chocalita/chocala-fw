<?php
require_once('DateDiff.php');

/**
 * Description of DateUtil
 *
 * @author ypra
 */
class DateUtil extends DateTime
{

    /**
     *
     * @param string $time
     * @param DateTimeZone $timezone
     */
    public function __construct($time='now', $timezone=null)
    {
        parent::__construct($time, $timezone);
    }

    /**
     * Return Date in ISO8601 format
     * @return string
     */
    public function __toString()
    {
        return $this->format('Y-m-d H:i');
    }

    /**
     *
     * @return string
     */
    public function getTimestamp()
    {
        return $this->format('U');
    }

    /**
     * Returns if the year is leap
     * @param int $year
     * @return bool
     */
    public static function isLeap($year)
    {
        return ($year%4==0 && $year%100!=0  || $year%400==0);
    }

    /**
     * Returns the number of days from a month corresponding to a year
     * @param int $month
     * @param int $year
     * @return int
     */
    public static function monthDays($month, $year)
    {
        switch($month){
            case 1:
                return 31;
            case 2:
                return self::isLeap($year)? 29: 28;
            case 3:
                return 31;
            case 4:
                return 30;
            case 5:
                return 31;
            case 6:
                return 30;
            case 7:
                return 31;
            case 8:
                return 31;
            case 9:
                return 30;
            case 10:
                return 31;
            case 11:
                return 30;
            case 12:
                return 31;
            default:
                return 30;
        }
    }

    /**
     * @param $fecha
     * @return null|string
     */
    public static function mysql($fecha)
    {
        $nfecha = explode("/",$fecha);
        if(is_array($nfecha)){
            return $nfecha[2]."-".$nfecha[1]."-".$nfecha[0];
        }
        return null;
    }

}