<?php

namespace Chocala\Http\Response\Exceptions;

use Chocala\Http\Response\Parts\StatusCode;

class HttpUnauthorizedException extends HttpResponseException
{
    public function __construct(?string $message = null, \Throwable $previous = null)
    {
        parent::__construct(StatusCode::UNATHORIZED($message), $previous);
    }
}
