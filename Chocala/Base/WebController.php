<?php

/**
 * Description of WebController
 * @author ypra
 */
abstract class WebController implements IController
{

    protected $allowedMethods = array();

    /**
     *
     * @var boolean
     */
    protected $rendered = false;

    /**
     * The view class engine that generate the html code to return to the client
     * @var WebView
     */
    protected $view = null;

    /**
     * The name of the layout that will be generated
     * @var string
     */
    protected $layout = null;

    /**
     * The template file that will be used for generate the page
     * @var string
     */
//    protected $template = null;

    /**
     * The ID that drive the page
     * @var mixed
     */
    protected $id = null;

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        if (property_exists($this, $name)) {
            $this->$name = $value;
        }
    }

    /**
     *
     */
    final public function __construct()
    {
        $this->id = GlobalVars::instance()->id();
        $this->layout = Configs::value('app.default.layout');
        $this->view = new WebView($this->layout);
    }

    /**
     * Initialization of generic operations, configurations or steps for all
     * methods of the controller class
     * @return void
     */
    public function _init()
    {
    }

    final public function isRendered()
    {
        return $this->rendered;
    }

    /**
     * Set a variable to view
     * @param string $name
     * @param mixed $value
     * @return WebController
     */
    final public function set($name, $value)
    {
        $this->view->setVar($name, $value);
        return $this;
    }

    /**
     * Send directly the content as response from the request page
     *
     * @param string $content
     * @return void
     */
    final public function render($content)
    {
        if (!$this->rendered) {
            echo "ABC";
            $this->view->render($content);
            $this->rendered = true;
        }
    }

    /**
     * Generate and display the html code from request page with action,
     * controller and module properties using the layout and template on the
     * view engine
     * @param string $view
     * @param string $module
     * @return void
     */
    final public function renderView($view, $module = null)
    {
        if (!$this->rendered) {
            $this->view->renderView(lcfirst($view), $module);
            $this->rendered = true;
        }
    }

    /**
     * Generate and send a json response encoding the controller's vars from
     * request page with action, controller and module
     *
     * @return void
     */
    final public function renderAsJSON()
    {
        if (!$this->rendered) {
            $this->view->renderJSON();
            $this->rendered = true;
        }
    }

    /**
     *
     * @param array|string $target
     * @param boolean $permanently
     * @return void
     */
    final public function redirectTo($target, $permanently = false)
    {
        $urlTarget = is_string($target) ? $target : URI::createURLTo($target);
        Headers::instance()->redirectTo($urlTarget, $permanently);
    }

    /**
     * Routing to default page for request to unexisting pages
     *
     * @return void
     */
    final public function noRoute()
    {
        $this->set('__exceptions', ChocalaErrorsManager::exceptions());
    }

    /**
     * Verify if the action is requested as a allowed method
     *
     * @param string $action
     * @param string $method
     * @return boolean
     */
    final public function isAllowedMethod($action)
    {
        $method = HttpManager::requestMethod();
        if (isset($this->allowedMethods[$action])) {
            return strtoupper(trim($this->allowedMethods[$action])) == $method;
        }
        return true;
    }

}