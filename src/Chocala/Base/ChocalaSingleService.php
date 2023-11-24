<?php

namespace Chocala\Base;

/**
 *
 * @author ypra
 * Date: 1/23/2016
 * Time: 6:18 a.m.
 */
abstract class ChocalaSingleService extends ChocalaService implements Singleton
{

    /**
     * @var \ChocalaSingleService
     */
    protected static $instance = null;

    /**
     * @return \ChocalaSingleService
     */
    public static function instance()
    {
        if(!is_object(self::$instance)) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    abstract public function _init();

    final private function __construct()
    {
        $this->_init();
    }

}