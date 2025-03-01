<?php

namespace Chocala\Base;

class IllegalStateException extends ChocalaException
{
    public function __construct(string $message, int $code = ILLEGAL_STATE_EXCEPTION, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
