<?php

namespace Chocala\Http;

use Chocala\Http\Request\Parts\HeadersInterface;
use Chocala\Http\Request\Parts\RequestDataInterface;
use Chocala\Http\Request\Parts\RequestLineInterface;

interface RequestInterface
{

    public function requestLine(): RequestLineInterface;

    public function headers(): HeadersInterface;

    public function requestData(): RequestDataInterface;

}