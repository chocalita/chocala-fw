<?php

namespace Chocala\Web;

use Chocala\Http\HttpMethodEnum;
use Chocala\Web\Result\ActionResultInterface;
use Chocala\Web\Result\ActionBodyInterface;

interface ControllerInterface
{

    public function _init(): void;

    public function _isAllowedMethod(string $action, HttpMethodEnum $method): bool;

    public function _bodyAs(ActionBodyInterface $actionBody): void;

    public function _process(string $actionName): ActionResultInterface;

}