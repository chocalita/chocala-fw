<?php

namespace Chocala\Web;

use Chocala\Http\HttpMethodEnum;
use Chocala\Web\Result\ActionDataInterface;
use Chocala\Web\Result\ActionResultInterface;

trait ControllerTrait
{

    protected array $_allowedMethods = [];

    protected ActionDataInterface $_data;

    protected ActionResultInterface $_defaultResult;

    protected bool $_isRendered = false;

    final public function _isAllowedMethod(string $action, HttpMethodEnum $method): bool
    {
        if (isset($this->_allowedMethods[$action])) {
            return strtoupper(trim($this->_allowedMethods[$action])) == $method;
        }
        return true;
    }

    final public function _result(): ActionResultInterface
    {
        return $this->_defaultResult;
    }

    final public function _isRendered(): bool
    {
        return $this->_isRendered;
    }

}