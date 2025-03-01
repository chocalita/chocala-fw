<?php

namespace Chocala\Base;

class UnsupportedOperationException extends ChocalaException
{
    public function __construct(string $message, int $code = UNSUPPORTED_EXCEPTION, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
