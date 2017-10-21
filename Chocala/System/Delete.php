<?php
/**
 * Description of Delete
 *
 * @author ypra
 */
class Delete extends GlobalVar
{

    /**
     * Represents a unique instance for the class in the system
     * @var Delete
     */
    private static $instance = null;

    /**
     *
     * @var string
     */
    protected $id = null;

    /**
     * A single class instance from this
     * @return Delete
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
        $this->name = 'DELETE';
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
        $this->data = &$_DELETE;
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
        $this->data = &$_DELETE;
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