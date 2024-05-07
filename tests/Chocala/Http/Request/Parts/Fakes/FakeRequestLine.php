<?php

namespace Chocala\Http\Request\Parts\Fakes;

use Chocala\Http\HttpMethod;
use Chocala\Http\HttpMethodEnum;
use Chocala\Http\Request\Parts\RequestLine;
use Chocala\Http\Request\Parts\RequestLineInterface;

class FakeRequestLine implements RequestLineInterface
{
    public const DEFAULT_REQUEST_URI = '/section/vx/resource';
    public const DEFAULT_HTTP_VERSION = 'HTTP/1.1';

    private RequestLineInterface $requestLine;

    public function __construct()
    {
        $this->requestLine = new RequestLine(
            HttpMethod::POST(),
            self::DEFAULT_REQUEST_URI,
            self::DEFAULT_HTTP_VERSION
        );
    }

    /**
     * @inheritDoc
     */
    public function method(): HttpMethodEnum
    {
        return $this->requestLine->method();
    }

    /**
     * @inheritDoc
     */
    public function requestUri(): string
    {
        return $this->requestLine->requestUri();
    }

    /**
     * @inheritDoc
     */
    public function httpVersion(): string
    {
        return $this->requestLine->httpVersion();
    }
}
