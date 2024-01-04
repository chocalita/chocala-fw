<?php

namespace Chocala\Web\Result;

use Chocala\Http\HeadersInterface;

interface ResultHeadersInterface extends HeadersInterface
{


    public function addHeader(string $key, $value): void;

}