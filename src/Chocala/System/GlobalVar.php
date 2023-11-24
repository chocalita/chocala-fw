<?php

namespace Chocala\System;

use Chocala\Base\Singleton;

/**
 * Description of Global
 *
 * @author ypra
 */
abstract class GlobalVar implements Singleton
{

    /**
     * @var string
     */
    protected $name = null;

    /**
     * Token encrypt data
     * @var boolean
     */
    protected $encrypted = false;

    /**
     * Global data
     * @var array
     */
    protected $data = array();

    /**
     * Session object is returned as a serialized string. If encryption is
     * enabled, the session will be encrypted as base 64 .
     * @return  string
     */
    public function __toString()
    {
        $data = serialize($this->data);
        if ($this->encrypted) {
            // TODO: return a encrypted array
            //$data = Encrypt::instance($this->encrypted)->encode($data);
            return $this->data;
        } else {
            return base64_encode($data);
        }
    }

    /**
     * 
     * @return array
     */
    public function data()
    {
        return $this->data;
    }

    /**
     * 
     * @param string $key
     * @return boolean
     */
    public function _has($key)
    {
        return array_key_exists($key, $this->data);
    }

    /**
     * Get a variable from the global var array.
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function _get($key, $default=null)
    {
        return $this->_has($key)? $this->data[$key]: $default;
    }

    /**
     * Set a variable in the data array.
     * @param string $key
     * @param mixed $value
     * @return \GlobalVar
     */
    public function _set($key, $value)
    {
        $this->data[$key] = $value;
        return $this;
    }

    /**
     * Set a variable by reference.
     * @param string $key
     * @param mixed $value
     * @return \GlobalVar
     */
    public function _bind($key, &$value)
    {
        $this->data[$key] = &$value;
        return $this;
    }

    /**
     * Removes a variable in the data array.
     * @param string $key
     * @return \GlobalVar
     */
    public function _delete($key)
    {
        unset($this->data[$key]);
        return $this;
    }

    /**
     * Get and delete a variable from the global var array.
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function _extract($key, $default=null)
    {
        $value = $this->_get($key, $default);
        $this->_delete($key);
        return $value;
    }

    /**
     * 
     * @param string $key
     * @return boolean
     */
    public static function has($key)
    {
        return static::instance()->_has($key);
    }

    /**
     * 
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function get($key, $default=null)
    {
        return static::instance()->_get($key, $default);
    }

    /**
     * 
     * @param string $key
     * @param mixed $value
     * @return \GlobalVar
     */
    public static function set($key, $value)
    {
        return static::instance()->_set($key, $value);
    }

    /**
     * 
     * @param string $key
     * @param mixed $value
     * @return \GlobalVar
     */
    public static function bind($key, &$value)
    {
        return static::instance()->_bind($key, $value);
    }

    /**
     * 
     * @param string $key
     * @return \GlobalVar
     */
    public static function delete($key)
    {
        return static::instance()->_delete($key);
    }

    /**
     * 
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function extract($key, $default=null)
    {
        return static::instance()->_extract($key, $default);
    }

    /**
     * Get a variable from the data.
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function _($key, $default=null)
    {
        return static::instance()->_get($key, $default);
//        return static::instance()->get($key, $default);
    }

    /**
     * Get a variable as Date from the data.
     * @param string $key
     * @param string $format
     * @param mixed $default
     * @return mixed
     */
    public static function _asDate($key, $format='d/m/Y', $default=null)
    {
        return static::has($key)? DateUtil::createFromFormat($format, static::_($key, $default)): null;
    }

    /**
     * @return array
     */
    public static function all()
    {
        return static::instance()->data();
    }

    /**
     * Loads the object data.
     * @param string $id
     * @return void
     */
    abstract protected function read($id=null);

    /**
     * Writes the current global var.
     * @return boolean
     */
    abstract protected function write();
    
    /**
     * Restart the global var.
     * @return boolean
     */
    abstract protected function restart();
    
    /**
     * Generate a new global var id and return it.
     * @return string
     */
    abstract protected function regenerate();

    /**
     * Destroy the global var id and return it.
     * @return string
     */
    abstract protected function destroy();

}