<?php

namespace Chocala\Http\Request;

use Chocala\Http\HeadersInterface;
use Chocala\Http\Mapping\UriMappingInterface;
use Chocala\Http\Request\Parts\RequestDataInterface;
use Chocala\Http\Request\Parts\RequestHeadersInterface;
use Chocala\Http\Request\Parts\RequestLine;
use Chocala\Http\Request\Parts\RequestLineInterface;
use Chocala\Http\RequestInterface;

class MappedRequest implements RequestInterface
{

    /**
     * @var RequestInterface
     */
    private RequestInterface $originalRequest;

    /**
     * @var UriMappingInterface
     */
    private UriMappingInterface $uriMapping;

    /**
     * @var RequestLineInterface|null
     */
    private ?RequestLineInterface $requestLine;

    public function __construct(RequestInterface $request, UriMappingInterface $uriMapping)
    {
        $this->originalRequest = &$request;
        $this->uriMapping = &$uriMapping;
        $this->requestLine = null;
    }

    /**
     * @return RequestLineInterface
     */
    public function requestLine(): RequestLineInterface
    {
        if (is_null($this->requestLine)) {
            $realUri = $this->uriMapping->realUri(
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
