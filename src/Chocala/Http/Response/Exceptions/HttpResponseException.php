<?php

namespace Chocala\Http\Response\Exceptions;

use Chocala\Base\ChocalaException;
use Chocala\Http\Exceptions\Throwable;
use Chocala\Http\Response\Parts\StatusCodeEnum;


class HttpResponseException extends ChocalaException implements HttpResponseExceptionInterface
{
    protected StatusCodeEnum $statusCode;

    public function __construct(StatusCodeEnum $statusCode, \Throwable $previous = null)
    {
        parent::__construct($statusCode->message(), $statusCode->code(), $previous);
        $this->statusCode = $statusCode;
    }

    public function statusCode(): StatusCodeEnum
    {
        return $this->statusCode;
    }
}
