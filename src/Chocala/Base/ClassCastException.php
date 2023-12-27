<?php

namespace Chocala\Base;

class ClassCastException extends \UnexpectedValueException
{

    public function __construct(string $message, int $code = CLASS_CAST_EXCEPTION, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}