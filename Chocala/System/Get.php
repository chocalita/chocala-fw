<?php
/**
 * Description of Get
 *
 * @author ypra
 */
class Get extends GlobalVar
{

    /**
     * Represents a unique instance for the class in the system
     * @var Get
     */
    private static $instance = null;

    /**
     *
     * @var string
     */
    protected $id = null;

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
        $this->name = 'GET';
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
     * @param string $id
     * @return void
     */
    public function read($id=null)
    {    
        $this->data = &$_GET;
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
        $this->data = &$_GET;
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