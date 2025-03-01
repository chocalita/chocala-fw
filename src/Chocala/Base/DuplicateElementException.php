<?php

namespace Chocala\Base;

class DuplicateElementException extends IllegalStateException
{
    public function __construct(string $message, int $code = DUPLICATE_ELEMENT_EXCEPTION, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
