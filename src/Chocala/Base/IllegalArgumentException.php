<?php

namespace Chocala\Base;

class IllegalArgumentException extends ChocalaException
{
    public function __construct(string $message, int $code = ILLEGAL_ARGUMENT_EXCEPTION, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
