<?php

namespace Chocala\Http\Mapping;

interface PatternMapInterface
{

    /**
     * @return string
     */
    public function pattern();

    /**
     * @return array
     */
    public function map();

}