<?php
require_once('PageControl.php');
require_once('UserControl.php');
/**
 * Description of SecurityRegistry
 *
 * @author ypra
 */
class SecurityRegistry implements ISingletonRegistry
{

    /**
     * Single static instance from this class
     * @var SecurityRegistry
     */
    private static $instance = null;

    /**
     * A single instance from PageControl
     * @var PageControl
     */
    private $pageControl = null;

    /**
     * A single instamce from UserControl
     * @var UserControl
     */
    private $userControl = null;

    /**
     * Returns a single instance from this class
     * @return SecurityRegistry
     */
    public static function instance()
    {
        if(self::$instance == null){
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * Private construct for Singleton utility, init the main security controls
     */
    private function __construct()
    {
        $this->userControl = new UserControl();
        $this->pageControl = new PageControl();
    }
    
    /**
     * 
     * @param string $var
     * @param Object $object
     */
    public static function updateRegistry($var, $object)
    {
        switch ($var) {
            case 'user':
                self::instance()->userControl = $object;
                break;
            case 'page':
                self::instance()->pageControl = $object;
                break;
        }
    }

    /**
     * Return a single instance of PageControl class
     * @return PageControl
     */
    public static function pageControl()
    {
        return self::instance()->pageControl;
    }

    /**
     * Return a single instance of UserControl class
     * @return UserControl
     */
    public static function userControl()
    {
        return self::instance()->userControl;
    }

}