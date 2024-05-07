<?php

namespace Chocala\Http\Response\Exceptions;

use Chocala\Http\Response\Parts\StatusCode;

class HttpServiceUnavailableException extends HttpResponseException
{
    public function __construct(?string $message = null, \Throwable $previous = null)
    {
        parent::__construct(StatusCode::SERVICE_UNAVAILABLE($message), $previous);
    }
}
