<?php

namespace Chocala\Http\Response\Parts;

/**
 * Enum class for HTTP Status codes
 */
class StatusCode implements StatusCodeEnum
{

    protected int $code;
    protected string $message;

    public function __construct(int $code, string $message)
    {
        $this->code = $code;
        $this->message = $message;
    }

    final public function code(): int
    {
        return $this->code;
    }

    final public function message(): string
    {
        return $this->message;
    }

    final public function __toString()
    {
        return strval($this->code);
    }

    final public static function CONTINUE(?string $message = null): StatusCodeEnum
    {
//        return new class extends StatusCode {
//            protected int $code = 100;
//            protected string $message = 'Continue';
//        };
        return new StatusCode(
            100,
            $message ?? 'Continue'
        );
    }

    final public static function OK(?string $message = null): StatusCodeEnum
    {
        return new StatusCode(
            200,
            $message ?? 'OK'
        );
    }

    final public static function CREATED(?string $message = null): StatusCodeEnum
    {
        return new StatusCode(
            201,
            $message ?? 'Created'
        );
    }

    final public static function MULTIPLE_CHOICES(?string $message = null): StatusCode
    {
        return new StatusCode(
            300,
            $message ?? 'Multiple Choices'
        );
    }

    final public static function BAD_REQUEST(?string $message = null): StatusCode
    {
        return new StatusCode(
            400,
            $message ?? 'Bad Request'
        );
    }

    final public static function UNATHORIZED(?string $message = null): StatusCode
    {
        return new StatusCode(
            401,
            $message ?? 'Unauthorized'
        );
    }

    final public static function X_402(?string $message = null): StatusCode
    {
        return new StatusCode(
            402,
            $message ?? 'Msg'
        );
    }

    final public static function FORBIDDEN(?string $message = null): StatusCode
    {
        return new StatusCode(
            403,
            $message ?? 'Forbidden'
        );
    }

    final public static function NOT_FOUND(?string $message = null): StatusCode
    {
        return new StatusCode(
            404,
            $message ?? 'Not Found'
        );
    }

    final public static function METHOD_NOT_ALLOWED(?string $message = null): StatusCode
    {
        return new StatusCode(
            405,
            $message ?? 'Method Not Allowed'
        );
    }

    final public static function NOT_ACCEPTABLE(?string $message = null): StatusCode
    {
        return new StatusCode(
            406,
            $message ?? 'Not Acceptable'
        );
    }

    final public static function SERVER_ERROR(?string $message = null): StatusCode
    {
        return new StatusCode(
            500,
            $message ?? 'Internal Server Error'
        );
    }

    final public static function CODE_501(?string $message = null): StatusCode
    {
        return new StatusCode(
            501,
            $message ?? 'code 501'
        );
    }

    final public static function CODE_502(?string $message = null): StatusCode
    {
        return new StatusCode(
            502,
            $message ?? 'code 502'
        );
    }

    final public static function SERVICE_UNAVAILABLE(?string $message = null): StatusCode
    {
        return new StatusCode(
            503,
            $message ?? 'Service Unavailable'
        );
    }

}