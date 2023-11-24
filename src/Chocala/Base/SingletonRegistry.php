<?php

namespace Chocala\Base;

/**
 * Description of SingletonRegistry
 *
 * @author ypra
 */
class SingletonRegistry implements ISingletonRegistry
{

    /**
     * Single static instance from this class
     * @var SingletonRegistry
     */
    private static $instance = null;

    /**
     * A single instance from GlobalVars
     * @var GlobalVars
     */
    private $globalVars = null;

    /**
     * Returns a single instance from this class
     * @return SingletonRegistry
     */
    public static function instance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Private construct for Singleton utility, init the main security controls
     */
    private function __construct()
    {
        $this->globalVars = new GlobalVars();
    }

    /**
     *
     * @param type $var
     * @param type $object
     */
    public static function updateRegistry($var, $object)
    {
    }

    public static function globalVars()
    {
        return self::instance()->globalVars;
    }

}