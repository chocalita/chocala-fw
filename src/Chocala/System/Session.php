<?php

namespace Chocala\System;

/**
 * Description of Session
 *
 * @author ypra
 */
class Session extends GlobalVar
{
    /**
     * Represents a unique instance for the class in the system
     * @var Session
     */
    protected static $instance = null;

    /**
     * Cookie lifetime
     * @var int
     */
    protected $lifetime = 0;

    /**
     * A single class instance from this
     * @return Session
     */
    public static function instance()
    {
        if (!is_object(static::$instance)) {
            static::$instance = new self();
        }
        return static::$instance;
    }

    private function __construct($id = null)
    {
        $this->name = 'SESSION';
        if ($this->encrypted) {
            // TODO: encrypted proccess
        }
        // TODO: setting an id
        $this->read($id);
    }

    /**
     * @return string
     */
    public function id()
    {
        return session_id();
    }

    /**
     *
     * @param string $id
     * @return void
     */
    public function read($id = null)
    {
//        Sync up the session cookie with Cookie parameters
//        session_set_cookie_params($this->lifetime, Cookie::$path,
//            Cookie::$domain, Cookie::$secure, Cookie::$httponly);
        session_set_cookie_params($this->lifetime);
        // Do not allow PHP to send Cache-Control headers
        session_cache_limiter(false);
        // Set the session cookie name
        session_name($this->name);
        if ($id) {
            session_id($id);
        }
        session_start();
        $this->data =& $_SESSION;
        return null;
    }

    /**
     *
     * @return boolean
     */
    public function write()
    {
        session_write_close();
        return true;
    }

    /**
     *
     * @return boolean
     */
    public function restart()
    {
        $status = session_start();
        $this->data =& $_SESSION;
        return $status;
    }

    /**
     *
     * @return string
     */
    public function regenerate()
    {
        session_regenerate_id();
        return session_id();
    }

    /**
     *
     * @return boolean
     */
    public function destroy()
    {
        session_destroy();
        $status = !session_id();
        if ($status) {
            // TODO: delete cookies from Cookie class
//            Cookie::delete($this->_name);
        }
        return $status;
    }
}
