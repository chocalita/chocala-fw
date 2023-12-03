<?php

namespace Chocala\Http\Response\Parts;

/**
 * Enum class for HTTP Status codes
 */
abstract class StatusCode implements StatusCodeInterface
{

    protected int $code;
    protected string $message;

    public function code(): int
    {
        return $this->code;
    }

    public function message(): string
    {
        return $this->message;
    }

    public static function OK(): StatusCode
    {
        return new class extends StatusCode
        {
            protected int $code = 200;
            protected string $message = 'OK';
        };
    }

    public static function CODE_300(): StatusCode
{
        return new class extends StatusCode
        {
            protected int $code = 300;
            protected string $message = 'CODE300';
        };
    }

    public static function CODE_400(): StatusCode
    {
        return new class extends StatusCode
        {
            protected int $code = 400;
            protected string $message = 'CODE_400';
        };
    }

}