<?php

namespace Chocala\Http;

abstract class HttpMethod
{

    public const GET = 'GET';
    public const POST = 'POST';
    public const PUT = 'PUT';
    public const PATCH = 'PATCH';
    public const DELETE = 'DELETE';
    public const OPTIONS = 'OPTIONS';
    public const HEAD = 'HEAD';
    public const CONNECT = 'CONNECT';
    public const TRACE = 'TRACE';

    public const METHODS = [self::GET, self::POST, self::PUT, self::PATCH, self::DELETE,
        self::OPTIONS, self::HEAD, self::CONNECT, self::TRACE];

    public const SAFE_METHODS = [self::GET, self::OPTIONS, self::HEAD, self::TRACE];

}