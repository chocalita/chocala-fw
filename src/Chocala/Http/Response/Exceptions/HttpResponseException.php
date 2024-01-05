<?php

namespace Chocala\Http\Response\Exceptions;

use Chocala\Base\ChocalaException;
use Chocala\Http\Exceptions\Throwable;
use Chocala\Http\Response\Parts\StatusCode;
use Chocala\Http\Response\Parts\StatusCodeEnum;

// TODO: Remove this constants
define('HTTP_BAD_REQUEST_RESPONSE_EXCEPTION', 400);
define('HTTP_UNAUTHORIZED_RESPONSE_EXCEPTION', 401);
define('HTTP_PAYMENT_REQUIRED_RESPONSE_EXCEPTION', 402);
define('HTTP_FORBIDDEN_RESPONSE_EXCEPTION', 403);
define('HTTP_NOT_FOUND_RESPONSE_EXCEPTION', 404);
define('HTTP_METHOD_NOT_ALLOWED_RESPONSE_EXCEPTION', 405);
define('HTTP_X_RESPONSE_EXCEPTION', 4000);
define('HTTP_Y_RESPONSE_EXCEPTION', 5000);


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