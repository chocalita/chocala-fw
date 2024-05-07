<?php

namespace Chocala\Http\Request\Parts;

use Chocala\Http\HttpMethodEnum;

class RequestLine implements RequestLineInterface
{
    public const DEFAULT_HTTP_VERSION = 'HTTP/1.1';

    /**
     * @var HttpMethodEnum
     */
    private HttpMethodEnum $method;

    /**
     * @var string
     */
    private string $requestUri;

    /**
     * @var string
     */
    private string $httpVersion;

    /**
     * RequestLine constructor.
     * @param HttpMethodEnum $method
     * @param string $requestUri
     * @param string $httpVersion
     */
    public function __construct(
        HttpMethodEnum $method,
        string $requestUri,
        string $httpVersion = self::DEFAULT_HTTP_VERSION
    )
    {
        $this->method = $method;
        $this->requestUri = $requestUri;
        $this->httpVersion = $httpVersion;
    }

    /**
     * @return HttpMethodEnum
     */
    public function method(): HttpMethodEnum
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function requestUri(): string
    {
        return $this->requestUri;
    }

    /**
     * @return string
     */
    public function httpVersion(): string
    {
        return $this->httpVersion;
    }
}
