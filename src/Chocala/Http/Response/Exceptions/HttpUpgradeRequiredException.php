<?php

namespace Chocala\Http\Response\Exceptions;

use Chocala\Http\Response\Parts\StatusCode;

class HttpUpgradeRequiredException extends HttpResponseException
{
    public function __construct(?string $message = null, \Throwable $previous = null)
    {
        parent::__construct(StatusCode::UPGRADE_REQUIRED($message), $previous);
    }
}
