<?php
/**
 * Description of ChocalaException
 *
 * @author ypra
 */
class ChocalaException extends \LogicException
{

    public function __construct($message)
    {
        parent::__construct($message);
    }

}