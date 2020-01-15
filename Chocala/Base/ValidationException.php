<?php
require_once 'ChocalaException.php';

/**
 * Description of ValidationException
 *
 * @author ypra
 */
class ValidationException extends ChocalaException
{

    public function __construct($message, $code = 580, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}