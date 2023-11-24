<?php

namespace Chocala\Http\Request;

use Chocala\Http\Mapping\UriMappingInterface;
use Chocala\Http\Parts\HeadersInterface;
use Chocala\Http\Parts\MessageBodyInterface;
use Chocala\Http\Parts\RequestLine;
use Chocala\Http\Parts\RequestLineInterface;
use Chocala\Http\RequestInterface;

class MappedRequest implements RequestInterface
{

    /**
     * @var RequestInterface
     */
    private $originalRequest;

    /**
     * @var UriMappingInterface
     */
    private $uriMapping;

    /**
     * @var RequestLineInterface
     */
    private $requestLine;

    public function __construct(RequestInterface $request, UriMappingInterface $uriMapping)
    {
        $this->originalRequest = &$request;
        $this->uriMapping = &$uriMapping;
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
     * @return HeadersInterface
     */
    public function headers(): HeadersInterface
    {
        return $this->originalRequest->headers();
    }

    /**
     * @return MessageBodyInterface
     */
    public function messageBody(): MessageBodyInterface
    {
        return $this->originalRequest->messageBody();
    }

}
