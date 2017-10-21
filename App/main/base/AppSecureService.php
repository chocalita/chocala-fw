<?php

/**
 * Created by PhpStorm.
 * User: Yecid
 * Date: 2/10/2016
 * Time: 11:52 p.m.
 */
abstract class AppSecureService extends GenericService
{

    /**
     * @var SysUser
     */
    protected $sessionUser = null;

    /**
     * @return GenericService
     */
    public static function instance()
    {
        $instance = parent::instance();
        if($instance->sessionUser == null){
            $instance->sessionUser = UserControl::user();
        }
        return $instance;
    }

}