<?php

namespace Chocala\Base;

/**
 * Description of NotFoundException
 *
 * @author ypra
 */
class NotFoundException extends ChocalaException
{
    public function __construct(string $message, int $code = NOT_FOUND_EXCEPTION, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
