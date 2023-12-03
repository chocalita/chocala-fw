<?php

namespace Chocala\Http\Mapping\Fakes;

use Chocala\Http\HttpMethodEnum;
use Chocala\Http\Mapping\UriMappingInterface;

class FakeUriMapping implements UriMappingInterface
{

    public function realUri(string $uri, HttpMethodEnum $method): string
    {
        return $uri;
    }

}
