<?php
require_once 'ChocalaException.php';

/**
 * Description of NotFoundException
 *
 * @author ypra
 */
class NotFoundException extends ChocalaException
{

    public function __construct($message, $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}