<?php

namespace Chocala\Http\Mapping;

interface UriMappingInterface
{

    public function realUri(string $uri, string $method): string;

}