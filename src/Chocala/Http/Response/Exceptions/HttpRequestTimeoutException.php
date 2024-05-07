<?php

namespace Chocala\Http\Response\Exceptions;

use Chocala\Http\Response\Parts\StatusCode;

class HttpRequestTimeoutException extends HttpResponseException
{
    public function __construct(?string $message = null, \Throwable $previous = null)
    {
        parent::__construct(StatusCode::REQUEST_TIMEOUT($message), $previous);
    }
}
