<?php

namespace Chocala\Http\Mapping\Fakes;

use Chocala\Http\Mapping\UriMappingInterface;

class FakeUriMapping implements UriMappingInterface
{

    public function realUri(string $uri, string $method): string
    {
        return $uri;
    }

}
