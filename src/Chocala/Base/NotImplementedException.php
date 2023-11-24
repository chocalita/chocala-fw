<?php

namespace Chocala\Base;

class NotImplementedException extends UnsupportedOperationException
{

    public function __construct(string $message, int $code = NOT_IMPLEMENTED_EXCEPTION, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}
