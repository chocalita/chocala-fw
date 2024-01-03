<?php

namespace Chocala\Web;

use Chocala\Http\HttpMethodEnum;
use Chocala\Web\Result\ActionResultInterface;

interface ControllerInterface
{

    public function _init(): void;

    public function _isAllowedMethod(string $action, HttpMethodEnum $method): bool;

    public function _result(): ActionResultInterface;

    public function _isRendered(): bool;

}