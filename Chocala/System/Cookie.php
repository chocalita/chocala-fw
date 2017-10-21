<?php
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
        if(!is_object(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct()
    {
        $this->name = 'COOKIE';
    }

    /**
     * 
     * @param string $id
     * @return void
     */
    public function read($id=null)
    {
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

}