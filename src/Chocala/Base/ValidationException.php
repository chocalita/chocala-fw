<?php

namespace Chocala\Base;

/**
 * Description of ValidationException
 *
 * @author ypra
 */
class ValidationException extends ChocalaException
{

    public function __construct($message, $code = VALIDATION_EXCEPTION, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}
