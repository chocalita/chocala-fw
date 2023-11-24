<?php

namespace Chocala\System;

/**
 * Description of Cookie
 *
 * @author ypra
 */
class Cookie extends GlobalVar
{

    /**
     * Represents a unique instance for the class in the system
     * @var Cookie
     */
    private static $instance = null;

    /**
     * A single class instance from this
     * @return Session
     */
    public static function instance()
    {
        if (!is_object(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct($id = null)
    {
        $this->name = 'COOKIE';
        //TODO: set and ID
        $this->read($id);
    }

    /**
     *
     * @param string $id
     * @return void
     */
    public function read($id = null)
    {
        $this->data = &$_COOKIE;
        return null;
    }

    /**
     *
     * @return boolean
     */
    public function write()
    {
    }

    /**
     *
     * @return boolean
     */
    public function restart()
    {
    }

    /**
     *
     * @return string
     */
    public function regenerate()
    {
    }

    /**
     *
     * @return boolean
     */
    public function destroy()
    {
    }


    /**
     * @param string $key
     * @param mixed $value
     * @param null $expire
     * @param bool $httponly
     * @param string $path
     * @param string $domain
     * @return GlobalVar
     */
    public static function set($key, $value, $expire = null, $httponly = false, $path = "", $domain = "")
    {
        $expire = time() + ($expire === null ? Config::_('cookie.default.expire') : $expire);
        $secure = (strtoupper(Config::_('app.run.environment')) != 'DEVELOPMENT');
        setcookie($key, $value, $expire, $path, $domain, $secure, $httponly);
        return parent::set($key, $value);
    }

    /**
     * @param string $key
     */
    public static function delete($key)
    {
        setcookie($key, null, time() - 86400);
        parent::delete($key);
    }


}