<?php


class EntityException extends ChocalaException
{

    const NO_ENTITY = 400;

    public function __construct($message, $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}