<?php

namespace Chocala\System\IO;

use Chocala\Base\ChocalaException;

class IOException extends ChocalaException
{
    public function __construct(string $message, int $code = IO_EXCEPTION, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
