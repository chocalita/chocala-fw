<?php

namespace Chocala\Http;

interface HttpMethodEnum
{
    public function name(): string;

    public function isSafe(): bool;

    public function equals(HttpMethodEnum $value): bool;
}
