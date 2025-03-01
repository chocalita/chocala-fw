<?php

namespace Chocala\Base;

class DuplicatedOperationException extends ChocalaException
{
    public function __construct(string $message, int $code = DUPLICATE_OPERATION_EXCEPTION, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
