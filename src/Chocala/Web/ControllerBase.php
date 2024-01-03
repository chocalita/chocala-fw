<?php

namespace Chocala\Web;

use Chocala\Web\Result\ActionData;
use Chocala\Web\Result\DefaultActionResult;
use Chocala\Web\Result\ActionResultInterface;

/*abstract/**/class ControllerBase implements ControllerInterface
{
    use ControllerTrait;

    public function __construct()
    {
        $this->_data = new ActionData();
        $this->_defaultResult = new DefaultActionResult();
    }

    /**
     * Initialization of generic operations, configurations or steps for all
     * methods of the controller class
     * @return void
     */
    public function _init(): void
    {
    }

    /**
     * Set a variable to _result
     *
     * @param string $name
     * @param mixed $value
     * @return $this
     */
    final public function set(string $name, $value): ControllerBase
    {
        $this->_data->setVar($name, $value);
        return $this;
    }

    /**
     * Send directly the content as response from the request page
     *
     * @return void
     */
    final public function render(): ActionResultInterface
    {
        if (!$this->_isRendered) {
            $this->_isRendered = true;
        }
        return $this->_defaultResult;
    }

}