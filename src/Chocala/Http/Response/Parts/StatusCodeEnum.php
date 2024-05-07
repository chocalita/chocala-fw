<?php

namespace Chocala\Http\Response\Parts;

interface StatusCodeEnum
{
    public function code(): int;

    public function message(): string;
}
