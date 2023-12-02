<?php

namespace Chocala\Http;

use Chocala\Http\Parts\HeadersInterface;
use Chocala\Http\Parts\RequestDataInterface;
use Chocala\Http\Parts\RequestLineInterface;

interface RequestInterface
{

    public function requestLine(): RequestLineInterface;

    public function headers(): HeadersInterface;

    public function requestData(): RequestDataInterface;

}