<?php

namespace Chocala\Http\Mapping;

class ActionMap implements ActionMapInterface
{

    /**
     * @var string
     */
    private $module;

    /**
     * @var string
     */
    private $controller;

    /**
     * @var string
     */
    private $action;

    /**
     * @var mixed
     */
    private $id;

    /**
     * @var array
     */
    private $params;

    public function __construct()
    {
        $get_arguments = func_get_args();
        $number_of_arguments = func_num_args();
        if (method_exists($this, $method_name = '__construct' . $number_of_arguments)) {
            call_user_func_array(array($this, $method_name), $get_arguments);
        } else {
            throw new \InvalidArgumentException('Invalid arguments to create object ' . __CLASS__);
        }
    }

    private function __constructor($module, $controller, $action, $id, $params)
    {
        $this->module = $module;
        $this->controller = $controller;
        $this->action = $action;
        $this->id = $id;
        // TODO: change to ->  !is_array($this->params)
        if (is_array($this->params)) {
            throw new \InvalidArgumentException('\'params\' value should be an array');
        }
        $this->params = $params;
    }

    private function __construct3($module, $controller, $action)
    {
        return $this->__construct4($module, $controller, $action, []);
    }

    private function __construct4($module, $controller, $action, $params)
    {
        return $this->__constructor($module, $controller, $action, null, $params);
    }

    private function __construct5($module, $controller, $action, $id, $params)
    {
        return $this->__constructor($module, $controller, $action, $id, $params);
    }

    /**
     * @return string
     */
    public function module()
    {
        return $this->module;
    }

    /**
     * @return string
     */
    public function controller()
    {
        return $this->controller;
    }

    /**+
     * @return string
     */
    public function action()
    {
        return $this->action;
    }

    /**
     * @return mixed
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * @return array
     */
    public function params()
    {
        return $this->params;
    }

}
