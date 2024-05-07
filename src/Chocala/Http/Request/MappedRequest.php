<?php

namespace Chocala\Http\Request;

use Chocala\Http\Request\Parts\RequestDataInterface;
use Chocala\Http\Request\Parts\RequestHeadersInterface;
use Chocala\Http\Request\Parts\RequestLine;
use Chocala\Http\Request\Parts\RequestLineInterface;
use Chocala\Http\RequestInterface;
use Chocala\Http\Route\RoutesMappingInterface;

class MappedRequest implements RequestInterface
{
    /**
     * @var RequestInterface
     */
    private RequestInterface $originalRequest;

    /**
     * @var RoutesMappingInterface
     */
    private RoutesMappingInterface $routesMapping;

    /**
     * Cache var for resolved requestLine
     * @var RequestLineInterface|null
     */
    private ?RequestLineInterface $requestLine;

    public function __construct(RequestInterface $request, RoutesMappingInterface $routesMapping)
    {
        $this->originalRequest = &$request;
        $this->routesMapping = &$routesMapping;
        $this->requestLine = null;
    }

    /**
     * @return RequestLineInterface
     */
    public function requestLine(): RequestLineInterface
    {
        if (is_null($this->requestLine)) {
            $realUri = $this->routesMapping->realUri(
                $this->originalRequest->requestLine()->requestUri(),
                $this->originalRequest->requestLine()->method()
            );
            $this->requestLine = new RequestLine(
                $this->originalRequest->requestLine()->method(),
                $realUri,
                $this->originalRequest->requestLine()->httpVersion()
            );
        }
        return $this->requestLine;
    }

    /**
     * @return RequestHeadersInterface
     */
    public function headers(): RequestHeadersInterface
    {
        return $this->originalRequest->headers();
    }

    /**
     * @return RequestDataInterface
     */
    public function requestData(): RequestDataInterface
    {
        return $this->originalRequest->requestData();
    }
}
