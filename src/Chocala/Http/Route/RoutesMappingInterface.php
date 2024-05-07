<?php

namespace Chocala\Http\Route;

use Chocala\Http\HttpMethodEnum;

interface RoutesMappingInterface
{
    public function realUri(string $uri, HttpMethodEnum $method): string;
}
