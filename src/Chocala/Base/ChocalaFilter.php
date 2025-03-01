<?php

namespace Chocala\Base;

/**
 * Description of ChocalaFilter
 *
 * @author ypra
 */
class ChocalaFilter implements IFilter
{
    protected $moduleName = null;

    protected $controllerName = null;

    protected $actionName = null;

    protected $id = null;

    final public function __construct()
    {
        $glbs = GlobalVars::instance();
        $this->moduleName = $glbs->module();
        $this->controllerName = $glbs->controller();
        $this->actionName = $glbs->action();
        $this->id = $glbs->id();
    }

    /**
     *
     * @param array $arrayMap
     * @param boolean $permanently
     * @return void
     */
    final public function redirectTo($arrayMap, $permanently = false)
    {
        $URI = URI::createURLTo($arrayMap);
        Headers::instance()->redirectTo($URI, $permanently);
    }

    public function beforeAction()
    {
    }

    public function afterAction()
    {
    }

    public function afterView()
    {
    }
}
