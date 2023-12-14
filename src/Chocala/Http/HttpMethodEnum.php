<?php

namespace Chocala\Http;

interface HttpMethodEnum
{

    public function name() : string;

    public function equals(HttpMethodEnum $value) : bool;

    public function isSafe() : bool;

}