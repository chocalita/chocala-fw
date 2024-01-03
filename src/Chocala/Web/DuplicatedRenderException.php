<?php

namespace Chocala\Web;

use Chocala\Base\DuplicatedOperationException;

class DuplicatedRenderException extends DuplicatedOperationException
{

    private const DEFAULT_MESSAGE = 'Operation render was did before.';
    public function __construct(string $message = self::DEFAULT_MESSAGE, int $code = DUPLICATE_OPERATION_EXCEPTION,
                                Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}