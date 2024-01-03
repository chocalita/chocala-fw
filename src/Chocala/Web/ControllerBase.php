<?php

namespace Chocala\Web;

use Chocala\Web\Result\ActionData;
use Chocala\Web\Result\DefaultActionResult;

abstract class ControllerBase implements ControllerInterface
{
    use ControllerTrait;

    public function __construct()
    {
        $this->_data = new ActionData();
        $this->_actionResult = new DefaultActionResult();
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

}