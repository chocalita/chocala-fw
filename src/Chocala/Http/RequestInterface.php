<?php

namespace Chocala\Http;

use Chocala\Http\Request\Parts\RequestDataInterface;
use Chocala\Http\Request\Parts\RequestHeadersInterface;
use Chocala\Http\Request\Parts\RequestLineInterface;

interface RequestInterface
{
    public function requestLine(): RequestLineInterface;

    public function headers(): RequestHeadersInterface;

    public function requestData(): RequestDataInterface;
}
