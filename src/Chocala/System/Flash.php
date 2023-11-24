<?php

namespace Chocala\System;

/**
 * Description of Flash
 *
 * @author ypra
 */
class Flash
{

    const FLASH_SESSION = '__FLASH';

    const MESSAGE_VAR = 'message';

    const INFO_VAR = 'info';

    const SUCCESS_VAR = 'success';

    const WARNING_VAR = 'warning';

    const ERROR_VAR = 'error';

    /**
     *
     * @var array
     */
    private $oldVars = null;

    /**
     * @var array
     */
    private $newVars = null;

    /**
     *
     * @return Flash
     */
    public static function initialize()
    {
        $flash = Session::_(self::FLASH_SESSION);
//        print_r($flash); exit();
        if(!is_object($flash)){
            $flash = new Flash();
        }
        $flash->oldVars = $flash->newVars?: [];
        $flash->newVars = [];
        Session::bind(self::FLASH_SESSION, $flash);
        return $flash;
    }

    /**
     * @return Flash
     */
    public static function instance()
    {
        if(!Session::has(self::FLASH_SESSION)){
            static::initialize();
        }
        return Session::_(self::FLASH_SESSION);
    }

    private function __construct()
    {
    }

    /**
     * @param $key
     * @return bool
     */
    public static function has($key)
    {
        return array_key_exists($key, static::instance()->oldVars[$key]);
    }

    /**
     * @param $key
     * @param null $default
     * @return mixed|null
     */
    public static function get($key, $default=null)
    {
        return static::instance()->_get($key, $default);
    }

    /**
     * @param $key
     * @param $value
     * @return Flash
     */
    public static function set($key, $value)
    {
        return static::instance()->_set($key, $value);
    }

    /**
     *
     * @param string $key
     * @param mixed $value
     * @return Flash
     */
    public static function bind($key, &$value)
    {
        return static::instance()->_set($key, $value);
    }

    /**
     *
     * @param string $key
     * @return Flash
     */
    public static function delete($key)
    {
        return static::instance()->_delete($key);
    }

    /**
     * @param $key
     * @param null $default
     * @return mixed
     */
    public static function extract($key, $default=null)
    {
        return static::instance()->_extract($key, $default);
    }

    /**
     *
     * @return void
     */
    public static function clean()
    {
        static::instance()->oldVars = [];
        static::instance()->newVars = [];
    }

    /**
     * @param $key
     * @param null $default
     * @return mixed|null
     */
    public static function _($key, $default=null)
    {
        return static::instance()->_get($key, $default);
    }

    /**
     * @param null $message
     * @return Flash|mixed|null
     */
    public static function message($message = null)
    {
        return is_null($message)? static::_(self::MESSAGE_VAR): static::set(self::MESSAGE_VAR, $message)
            ->get(self::MESSAGE_VAR);
    }

    /**
     * @param null $info
     * @return Flash|mixed|null
     */
    public static function info($info = null)
    {
        return is_null($info)? static::_(self::INFO_VAR): static::set(self::INFO_VAR, $info);
    }

    /**
     * @param null $success
     * @return Flash|mixed|null
     */
    public static function success($success = null)
    {
        return is_null($success)? static::_(self::SUCCESS_VAR): static::set(self::SUCCESS_VAR, $success);
    }

    /**
     * @param null $warning
     * @return Flash|mixed|null
     */
    public static function warning($warning = null)
    {
        return is_null($warning)? static::_(self::WARNING_VAR): static::set(self::WARNING_VAR, $warning);
    }

    /**
     * @param null $error
     * @return Flash|mixed|null
     */
    public static function error($error = null)
    {
        return is_null($error)? static::_(self::ERROR_VAR): static::set(self::ERROR_VAR, $error);
    }

    /**
     * @return array
     */
    public static function all()
    {
        return static::instance()->oldVars;
    }

    /**
     * @param $key
     * @param null $default
     * @return mixed
     */
    public function _get($key, $default=null)
    {
        return isset($this->oldVars[$key])? $this->oldVars[$key]: $default;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return Flash
     */
    public function _set($key, $value)
    {
        $this->oldVars[$key] = $value;
        $this->newVars[$key] = $value;
        return $this;
    }

    /**
     * @param $key
     * @return Flash
     */
    public function _delete($key)
    {
        unset($this->oldVars[$key]);
        unset($this->newVars[$key]);
        return $this;
    }

    /**
     * @param $key
     * @param null $default
     * @return mixed
     */
    public function _extract($key, $default=null)
    {
        $value = $this->_get($key, $default);
        $this->_delete($key);
        return $value;
    }

}