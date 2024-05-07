<?php

namespace Chocala\Http\Mapping;

interface UriMappingInterface
{
    public function matchCase(string $uri): array;
}
