<?php

namespace Chocala\Web;

use Chocala\Http\HttpMethodEnum;
use Chocala\Web\Result\ActionDataInterface;
use Chocala\Web\Result\ActionResultInterface;

trait ControllerTrait
{

    protected array $_allowedMethods = [];

    protected ActionDataInterface $_data;

    protected ActionResultInterface $_actionResult;

    protected bool $_isRendered = false;

    final public function _isAllowedMethod(string $action, HttpMethodEnum $method): bool
    {
        if (isset($this->_allowedMethods[$action])) {
            return strtoupper(trim($this->_allowedMethods[$action])) == $method;
        }
        return true;
    }

    final public function _apply(ActionResultInterface $actionResult)
    {
        $this->_actionResult = $actionResult;
    }

    /**
     * Generates content for the Response
     *
     * @return mixed
     */
    final public function _render()
    {
        if (!$this->_isRendered) {
            $this->_isRendered = true;
            return $this->_actionResult->result($this->_data);
        }
        throw new DuplicatedRenderException();
    }

}