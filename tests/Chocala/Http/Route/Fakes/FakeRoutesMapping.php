<?php

namespace Chocala\Http\Route\Fakes;

use Chocala\Http\HttpMethodEnum;
use Chocala\Http\Route\RoutesMappingInterface;

class FakeRoutesMapping implements RoutesMappingInterface
{
    public function realUri(string $uri, HttpMethodEnum $method): string
    {
        return $uri;
    }
}
