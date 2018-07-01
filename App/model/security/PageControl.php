<?php
require_once('Page.php');
require_once('PageConfigs.php');
require_once('UserControl.php');
/**
 * PageControl class (Singleton Registered)
 * SINGLETON Pattern (SINGLETON REFACTORIZED)
 *
 * @author ypra
 */
class PageControl implements ISingleton
{

    /**
     *
     * @var array
     */
    private static $modules = array();

    /**
     *
     * @var Page
     */
    private static $page = null;

    /**
     *
     * @var string
     */
    private static $backURI = '';

    /**
     *
     * @var bool
     */
    private static $canAdd = false;

    /**
     *
     * @var bool
     */
    private static $canBack = false;

    /**
     *
     * @var bool
     */
    private static $canFilter = false;

    /**
     *
     * @var bool
     */
    private static $canPaginate = false;

    /**
     *
     * @var bool
     */
    private static $canRefresh = false;

    /**
     *
     * @return Page
     */
    public static function page()
    {
        return self::$page;
    }

    /**
     *
     * @return string
     */
    public static function backURI()
    {
        return self::$backURI;
    }

    /**
     *
     * @param string $backURI
     * @return void
     */
    public static function setBackURI($backURI)
    {
        self::$backURI = $backURI;
    }

    /**
     *
     * @return bool
     */
    public static function isRegistered()
    {
        return !is_null(self::$page->URI());
    }

    /**
     *
     * @return bool
     */
    public static function canAdd()
    {
        return (self::$canAdd && self::$page->autCreate());
    }

    /**
     *
     * @return void
     */
    public static function noAdd()
    {
        self::$canAdd = false;
    }

    /**
     *
     * @return bool
     */
    public static function canBack()
    {
        return (self::$canBack && !empty(self::$backURI));
    }

    /**
     *
     * @return void
     */
    public static function noBack()
    {
        self::$canBack = false;
    }

    /**
     *
     * @return bool
     */
    public static function canFilter()
    {
        return self::$canFilter;
    }

    /**
     *
     * @return void
     */
    public static function noFilter()
    {
        self::$canFilter = false;
    }

    /**
     *
     * @return bool
     */
    public static function canPaginate()
    {
        return self::$canPaginate;
    }

    /**
     *
     * @return void
     */
    public static function noPaginate()
    {
        self::$canPaginate = false;
    }

    /**
     *
     * @return bool
     */
    public static function canRefresh()
    {
        return self::$canRefresh;
    }

    /**
     *
     * @return void
     */
    public static function noRefresh()
    {
        self::$canRefresh = false;
    }

    /**
     *
     * @return PageControl
     */
    public static function instance()
    {
        return SecurityRegistry::instance()->pageControl();
    }

    public function __construct()
    {        
        $uris = URI::subsequentURIs();
        self::$page = Page::createFrom($uris, UserControl::user());        
    }

    /**
     * 
     * @param SysUser $user
     * @param boolean $onlyMenu
     * @return array
     */
    public static function userPages(SysUser $user, $onlyMenu = false)
    {
        $rols = $user->inOrderRols();
        $modulesHash = array();
        $uris = SysUriQuery::create()
                ->distinct()
                ->_if($onlyMenu)
                    ->filterByType(PageConfigs::TYPE_MENU)
                ->_endif()
                ->useSysRolXUriQuery()
                    ->filterBySysRol($rols, Criteria::IN)
                ->endUse()
                ->useSysModuleQuery()
//                    ->orderByPosition()
                    ->withColumn("SysModule.position", "ModulePosition")
                    ->orderBy("ModulePosition", "asc")
                ->endUse()
                ->orderByPosition()
            ->find();
        foreach ($uris as $uri){
            $module = $uri->getSysModule();
            if(!isset($modulesHash[$module->getId()])){
                $modulesHash[$module->getId()]['module'] = $module;
                $modulesHash[$module->getId()]['uris'] = array();
            }
            array_push($modulesHash[$module->getId()]['uris'], $uri);
        }
        return $modulesHash;        
    }

    /**
     * Return a determinate main module
     * @param string $section
     * @return array
     */
    public static function section($section="all")
    {
        if($section=="all"){
            return self::$modules;
        }else{
            return self::$modules[$section];
        }
    }

    /**
     * Returns all modules that exist in the system.
     * @return array
     */
    public static function allModules()
    {
        $sysModules = SysModuleQuery::create()->orderByPosition()->find();
        $sysUris = SysUriQuery::create()->orderByPosition()->find();
        $uris = $sysUris->getData();
        $modules = array();
        foreach ($sysModules as $sysModule){
            $modules[$sysModule->getUri()] = array('module' => $sysModule,
                'uris' => array_filter($uris, function($obj) use ($sysModule){
                        return $obj->getSysModule()->equals($sysModule);
                    })
                );
        }
        return $modules;
    }

    /**
     * Verify page access
     * @return bool
     */
    public static function hasAccess()
    {
        if(self::page()->getAccess() == PageConfigs::ACCESS_PUBLIC){
            return true;
        }elseif(UserControl::loginVerify()){
            return true;
        }else{
            return false;
        }
    }

    /**
     *
     * @return bool
     */
    public static function canCreate()
    {
        return self::$page->autCreate();
    }

    /**
     *
     * @return bool
     */
    public static function canUpdate()
    {
        return self::$page->autUpdate();
    }

    /**
     *
     * @return bool
     */
    public static function canDelete()
    {
        return self::$page->autDelete();
    }

    /**
     *
     * @return bool
     */
    public static function canRead()
    {
        return self::$page->autRead();
    }

    /**
     * @return void
     */
    public static function noFunctionalityBar()
    {
        self::$canAdd = false;
        self::$canBack = false;
        self::$canFilter = false;
        self::$canPaginate = false;
        self::$canRefresh = false;
    }

}