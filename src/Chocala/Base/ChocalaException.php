<?php

namespace Chocala\Base;

use Throwable;

define('IO_EXCEPTION', 21);
define('ILLEGAL_STATE_EXCEPTION', 22);
define('CLASS_CAST_EXCEPTION', 23);
define('DUPLICATE_ELEMENT_EXCEPTION', 24);
define('ILLEGAL_ARGUMENT_EXCEPTION', 31);
define('DUPLICATE_OPERATION_EXCEPTION', 34);
define('UNSUPPORTED_EXCEPTION', 41);
define('NOT_IMPLEMENTED_EXCEPTION', 42);
define('NOT_FOUND_EXCEPTION', 44);
define('VALIDATION_EXCEPTION', 46);

/**
 * Description of ChocalaException
 *
 * @author ypra
 */
class ChocalaException extends \LogicException
{
    /**
     * Construct a Chocala framework exception.
     * @param string $message The Exception message to throw (message is NOT binary safe).
     * @param int $code The Exception code.
     * @param Throwable|null $previous [optional] The previous throwable used for the exception chaining.
     * @since 3.0
     */
    public function __construct(string $message, int $code, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * Gets the Exception message
     * @return string the Exception message as a string.
     */
    public function message(): string
    {
        return $this->getMessage();
    }
}
