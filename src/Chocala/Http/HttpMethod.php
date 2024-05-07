<?php

namespace Chocala\Http;

abstract class HttpMethod implements HttpMethodEnum
{
    protected string $name;
    protected bool $isSafe = false;

    final public function name(): string
    {
        return $this->name;
    }

    final public function isSafe(): bool
    {
        return $this->isSafe;
    }

    final public function equals(HttpMethodEnum $value): bool
    {
        return $this->name === $value->name();
    }

    final public function __toString()
    {
        return $this->name;
    }


    public static function all(): array
    {
        return [
            self::GET(),
            self::POST(),
            self::PUT(),
            self::PATCH(),
            self::DELETE(),
            self::OPTIONS(),
            self::HEAD(),
            self::CONNECT(),
            self::TRACE()
        ];
    }

    public static function GET(): HttpMethod
    {
        return new class extends HttpMethod
        {
            protected string $name = 'GET';
            protected bool $isSafe = true;
        };
    }

    public static function POST(): HttpMethod
    {
        return new class extends HttpMethod
        {
            protected string $name = 'POST';
            protected bool $isSafe = false;
        };
    }

    public static function PUT(): HttpMethod
    {
        return new class extends HttpMethod
        {
            protected string $name = 'PUT';
            protected bool $isSafe = false;
        };
    }

    public static function PATCH(): HttpMethod
    {
        return new class extends HttpMethod
        {
            protected string $name = 'PATCH';
            protected bool $isSafe = false;
        };
    }

    public static function DELETE(): HttpMethod
    {
        return new class extends HttpMethod
        {
            protected string $name = 'DELETE';
            protected bool $isSafe = true;
        };
    }

    public static function OPTIONS(): HttpMethod
    {
        return new class extends HttpMethod
        {
            protected string $name = 'OPTIONS';
            protected bool $isSafe = true;
        };
    }

    public static function HEAD(): HttpMethod
    {
        return new class extends HttpMethod
        {
            protected string $name = 'HEAD';
            protected bool $isSafe = true;
        };
    }

    public static function CONNECT(): HttpMethod
    {
        return new class extends HttpMethod
        {
            protected string $name = 'CONNECT';
            protected bool $isSafe = false;
        };
    }

    public static function TRACE(): HttpMethod
    {
        return new class extends HttpMethod
        {
            protected string $name = 'TRACE';
            protected bool $isSafe = true;
        };
    }


//    public const GET = 'GET';
//    public const POST = 'POST';
//    public const PUT = 'PUT';
//    public const PATCH = 'PATCH';
//    public const DELETE = 'DELETE';
//    public const OPTIONS = 'OPTIONS';
//    public const HEAD = 'HEAD';
//    public const CONNECT = 'CONNECT';
//    public const TRACE = 'TRACE';

//    public const METHODS = [self::GET, self::POST, self::PUT, self::PATCH, self::DELETE,
//        self::OPTIONS, self::HEAD, self::CONNECT, self::TRACE];
//
//    public const SAFE_METHODS = [self::GET, self::OPTIONS, self::HEAD, self::TRACE];
}
