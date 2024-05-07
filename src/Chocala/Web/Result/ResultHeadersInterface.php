<?php

namespace Chocala\Web\Result;

use Chocala\Http\Response\Parts\ResponseHeadersInterface;

interface ResultHeadersInterface extends ResponseHeadersInterface
{
    public function addHeader(string $key, $value): void;
}
