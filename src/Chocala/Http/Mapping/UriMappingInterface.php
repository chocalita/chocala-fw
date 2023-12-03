<?php

namespace Chocala\Http\Mapping;

use Chocala\Http\HttpMethodEnum;

interface UriMappingInterface
{

    public function realUri(string $uri, HttpMethodEnum $method): string;

}