<?php

namespace Chocala\Http\Response\Exceptions;

use Chocala\Http\Exceptions\HttpExceptionInterface;
use Chocala\Http\Response\Parts\StatusCodeEnum;

interface HttpResponseExceptionInterface extends HttpExceptionInterface
{
    public function statusCode(): StatusCodeEnum;
}
