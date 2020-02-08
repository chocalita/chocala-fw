<?php
require_once 'ChocalaException.php';

/**
 * Description of ForbiddenException
 *
 * @author ypra
 */
class ForbiddenException extends ChocalaException
{

    public function __construct($message, $code = 403, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}