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

    final public static function ACCEPTED(?string $message = null): StatusCodeEnum
    {
        return new StatusCode(
            202,
            $message ?? 'Accepted'
        );
    }

    final public static function NON_AUTHORITATIVE(?string $message = null): StatusCodeEnum
    {
        return new StatusCode(
            203,
            $message ?? 'Non-Authoritative Information'
        );
    }

    final public static function NO_CONTENT(?string $message = null): StatusCodeEnum
    {
        return new StatusCode(
            204,
            $message ?? 'No Content'
        );
    }

    final public static function RESET_CONTENT(?string $message = null): StatusCodeEnum
    {
        return new StatusCode(
            205,
            $message ?? 'Reset Content'
        );
    }

    final public static function PARTIAL_CONTENT(?string $message = null): StatusCodeEnum
    {
        return new StatusCode(
            206,
            $message ?? 'Partial Content'
        );
    }

    final public static function MULTI_STATUS(?string $message = null): StatusCodeEnum
    {
        return new StatusCode(
            207,
            $message ?? 'Multi-Status'
        );
    }

    final public static function MULTIPLE_CHOICES(?string $message = null): StatusCode
    {
        return new StatusCode(
            300,
            $message ?? 'Multiple Choices'
        );
    }

    final public static function MOVED_PERMANENTLY(?string $message = null): StatusCode
    {
        return new StatusCode(
            301,
            $message ?? 'Moved Permanently'
        );
    }

    final public static function MOVED_TEMPORARILY(?string $message = null): StatusCode
    {
        return new StatusCode(
            302,
            $message ?? 'Moved temporarily'
        );
    }

    final public static function SEE_OTHER(?string $message = null): StatusCode
    {
        return new StatusCode(
            303,
            $message ?? 'See Other'
        );
    }

    final public static function NOT_MODIFIED(?string $message = null): StatusCode
    {
        return new StatusCode(
            304,
            $message ?? 'Not Modified'
        );
    }

    final public static function USE_PROXY(?string $message = null): StatusCode
    {
        return new StatusCode(
            305,
            $message ?? 'Use Proxy'
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

    final public static function PROXY_AUTHENTICATION_REQUIRED(?string $message = null): StatusCode
    {
        return new StatusCode(
            407,
            $message ?? 'Proxy Authentication Required'
        );
    }

    final public static function REQUEST_TIMEOUT(?string $message = null): StatusCode
    {
        return new StatusCode(
            408,
            $message ?? 'Request Timeout'
        );
    }

    final public static function UNPROCESSABLE_CONTENT(?string $message = null): StatusCode
    {
        return new StatusCode(
            422,
            $message ?? 'Unprocessable Content'
        );
    }

    final public static function UPGRADE_REQUIRED(?string $message = null): StatusCode
    {
        return new StatusCode(
            426,
            $message ?? 'Upgrade Required'
        );
    }

    final public static function SERVER_ERROR(?string $message = null): StatusCode
    {
        return new StatusCode(
            500,
            $message ?? 'Internal Server Error'
        );
    }

    final public static function NOT_IMPLEMENTED(?string $message = null): StatusCode
    {
        return new StatusCode(
            501,
            $message ?? 'Not Implemented'
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
