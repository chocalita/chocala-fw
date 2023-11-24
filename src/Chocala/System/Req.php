<?php

namespace Chocala\System;

/**
 * Description of Req
 *
 * @author ypra
 */
class Req extends GlobalVar
{

    /**
     * Represents a unique instance for the class in the system
     * @var Req
     */
    protected static $instance = null;

    /**
     *
     * @var string
     */
    protected $id = null;

    /**
     *
     * @var string
     */
    protected $method = null;

    /**
     * A single class instance from this
     * @return Get
     */
    public static function instance()
    {
        if(!is_object(static::$instance)){
            static::$instance = new self();
        }
        return static::$instance;
    }

    private function __construct()
    {
        $this->name = 'REQUEST';
        $this->read();
    }

    /**
     * @return string
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * 
     * @return string
     */
    public function method()
    {
        return $this->method;
    }

    /**
     * 
     * @param string $id
     * @return void
     */
    public function read($id=null)
    {    
        $this->data = &$_REQUEST;
        return null;
    }

    /**
     * 
     * @return boolean
     */
    public function write()
    {
        return true;
    }

    /**
     * 
     * @return boolean
     */
    public function restart()
    {
        $this->data = &$_REQUEST;
        return true;
    }

    /**
     * 
     * @return string
     */
    public function regenerate()
    {
        return $this->id;
    }

    /**
     * 
     * @return boolean
     */
    public function destroy()
    {
        $this->destroy();
    }

}