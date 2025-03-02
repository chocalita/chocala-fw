<?php
/**
 * Description of Post
 *
 * @author ypra
 */
class Post extends GlobalVar
{

    /**
     * Represents a unique instance for the class in the system
     * @var Post
     */
    private static $instance = null;

    /**
     *
     * @var string
     */
    private $id = null;

    /**
     * A single class instance from this
     * @return Session
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
        $this->name = 'POST';
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
        $this->data = &$_POST;
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
        $this->data = &$_POST;
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