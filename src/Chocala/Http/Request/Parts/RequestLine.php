<?php

namespace Chocala\Http\Request\Parts;

use Chocala\Base\IllegalArgumentException;
use Chocala\Http\HttpMethod;

class RequestLine implements RequestLineInterface
{

    /**
     * @var string
     */
    private string $method;

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
     * @param string $method
     * @param string $requestUri
     * @param string $httpVersion
     */
    public function __construct(string $method, string $requestUri, string $httpVersion)
    {
        if (!in_array($method, HttpMethod::METHODS)) {
            throw new IllegalArgumentException(sprintf('Invalid \'%s\' method', $method));
        }
        $this->method = $method;
        $this->requestUri = $requestUri;
        $this->httpVersion = $httpVersion;
    }

    /**
     * @return string
     */
    public function method(): string
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
