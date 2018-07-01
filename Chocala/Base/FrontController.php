<?php
/**
 * FrontController Class (Singleton)
 * SINGLETON Pattern
 * @author ypra
 */
class FrontController implements IFrontController, ISingleton
{

    /** Suffix for controller classes */
    const SUFFIX_CONTROLLER = 'Controller';

    /** Modules path */
    const PORTAL_PATH = 'Modules.';

    /** Path of control's aliases */
    const ALIAS_PATH = 'Alias.';

    /**
     *
     * @var FrontController
     */
    private static $instance = null;

    /**
     * Represents the module name that correspond to the running
     * @var string
     */
    private $module = null;

    /**
     * Represents the name of the controller class for operate the system
     * @var string
     */
    private $controller = null;

    /**
     * Represents the method name of the controller class that runner the system
     * @var string
     */
    private $action = null;
    
    /**
     * @var string
     */
    private $classPath = '';

    /**
     *
     * @return FrontController
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
        $gvr = GlobalVars::instance();
        if(ChocalaAlias::isAlias($gvr->module())){
            $this->aliasRouting($gvr);
        }else{
            $this->regularRouting($gvr);
        }
    }

    /**
     * 
     * @param GlobalVars $gvr
     */
    private function regularRouting(GlobalVars $gvr)
    {
        try{
            $modulePath = self::PORTAL_PATH;
            $this->classPath = $modulePath;
            if(ChocalaVars::asBoolean(Configs::value('app.run.modular'))){
                $module = lcfirst(trim($gvr->module()!=''?
                        str_replace('-', '.', $gvr->module()):
                        Configs::value('app.default.module')));
                $modulePath.= $module;
                $this->classPath = $modulePath.'.';
                if(Chocala::exist(Chocala::namespacePath($modulePath))){
                    $this->module = $module;
                }
            }
            $this->genericRouting($gvr);
        }catch(ChocalaException $che){
            ChocalaErrorsManager::manage($che);
            $this->noRouted();
        }
    }

    /**
     * 
     * @param GlobalVars $gvr
     */
    private function aliasRouting(GlobalVars $gvr)
    {
        try{
            $this->classPath = self::ALIAS_PATH.
                    ChocalaAlias::aliasDir(lcfirst($gvr->module())).'.'.
                            lcfirst(self::PORTAL_PATH);
            if(Chocala::exist(Chocala::namespacePath($this->classPath))){
                $this->module = $gvr->module();
                $this->genericRouting($gvr);
            }else{
                $this->regularRouting($gvr);
            }
        }catch(ChocalaException $che){
            ChocalaErrorsManager::manage($che);
            $this->noRouted();
        }
    }

    /**
     * 
     * @param GlobalVars $gvr
     * @throws ChocalaException
     */
    public function genericRouting(GlobalVars $gvr)
    {
        try {
            $domain = trim($gvr->controller() != '' ? $gvr->controller() :
                Configs::value('app.default.controller'));
            $controller = ucfirst($domain);
            $class = $controller . self::SUFFIX_CONTROLLER;
            $controllerDir = $this->classPath . $domain;
            $controllerPath = $controllerDir . '.' . $class;
            if (!Chocala::exist(Chocala::namespacePath($controllerDir))) {
                throw new ChocalaException(ChocalaErrors::DIRECTORY_NOT_FOUND);
            } elseif (!Chocala::exist(Chocala::namespacePath($controllerPath) .
                Chocala::CLASS_EXTENSION, false)) {
                throw new ChocalaException(ChocalaErrors::CLASS_NOT_FOUND);
            } else {
                Chocala::import($controllerPath);
                $action = lcfirst(trim($gvr->action() != '' ? $gvr->action() :
                    Configs::value('app.default.action')));
                if (Chocala::classImplements($class, 'IController')) {
                    if (Chocala::classHasMethod($class, $action)) {
                        $this->controller = $controller;
                        $this->action = $action;
                    } else {
                        throw new ChocalaException(ChocalaErrors::
                        CLASS_NOT_HAS_METHOD);
                    }
                } else {
                    throw new ChocalaException(ChocalaErrors::
                    CLASS_NOT_IMPLEMENTS_INTERFACE);
                }
            }
        } catch (ChocalaException $che) {
            ChocalaErrorsManager::manage($che);
            if (strtoupper(Configs::value('app.run.environment')) != 'DEVELOPMENT') {
                HttpManager::responseAs404();
//                header($_SERVER['SERVER_PROTOCOL'] . ' 301 Moved Permanently');
//                header('Location: ' . WEB_ROOT);
//                exit();
            } else {
                echo $che->getCode().': '.$che->getMessage();
                exit();
                // TODO: manage NOT FOUND or another exceptions
                if (ChocalaVars::asBoolean(Configs::value('app.run.modular')) &&
                    $this->module == null) {
                    $this->module = Configs::value('app.default.module');
                }
                if ($this->controller == null) {
                    $this->module = ChocalaVars::asBoolean(
                        Configs::value('app.run.modular')) ?
                        Configs::value('app.default.module') : null;
                    $this->controller = ucfirst(
                        Configs::value('app.default.controller'));
                }
                if ($this->action == null) {
                    $this->action = ChocalaVars::NO_ROUTE;
                }
            }
        }
    }

    /**
     * 
     */
    public function noRouted()
    {
        if(ChocalaVars::asBoolean(Configs::value('app.run.modular'))){
            if($this->module == null){
                $this->module = lcfirst(
                        Configs::value('app.default.module'));
            }
        }
        if($this->controller == null){
            if(ChocalaVars::asBoolean(Configs::value('app.run.modular'))){
                $this->module = lcfirst(
                        Configs::value('app.default.module'));
            }
            $this->controller = ucfirst(
                    Configs::value('app.default.controller'));
        }
        if($this->action == null){
            $this->action = lcfirst(Configs::value('app.default.404'));
        }
    }

    /**
     * Ruote to the process of the page to controller and action
     * @return void
     */
    public function route()
    {
        try{
            $class = $this->controller.self::SUFFIX_CONTROLLER;
            $module = $this->module;
            $action = $this->action;
            $this->controllerCall($module, $class, $action);
        }catch(ChocalaException $che){
            print_r($che);
            ChocalaErrorsManager::manage($che);
        }
    }
    
    /**
     * 
     * @param string $module
     * @param string $class
     * @param string $action
     */
    public function controllerCall($module, $class, $action)
    {
        $controller = new $class();
        if($controller->isAllowedMethod($action)){
            foreach(ChocalaFiltersManager::filters() as $filter){
                $filter->beforeAction();
            }
            ChocalaPreprocessor::preprocessServices($controller);
            $controller->_init();
            $controller->$action();
            foreach(ChocalaFiltersManager::filters() as $filter){
                $filter->afterAction();
            }
            if(!$controller->isRendered()){
                $controller->renderView($this->controller.'.'.$this->action,
                        $this->module);
            }
            foreach(ChocalaFiltersManager::filters() as $filter){
                $filter->afterView();
            }
        }else{
            HttpManager::responseAs405();
        }
    }

}