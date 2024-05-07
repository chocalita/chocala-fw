<?php

namespace Chocala\Http\Mapping;

interface PatternMapInterface
{
    /**
     * @return string
     */
    public function pattern(): string;

    /**
     * @return array
     */
    public function map(): array;
}
