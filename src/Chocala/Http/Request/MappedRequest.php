<?php

namespace Chocala\Http\Request;

use Chocala\Http\Mapping\UriMappingInterface;
use Chocala\Http\Parts\HeadersInterface;
use Chocala\Http\Parts\MessageContentInterface;
use Chocala\Http\Parts\RequestLine;
use Chocala\Http\Parts\RequestLineInterface;
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
     * @return HeadersInterface
     */
    public function headers(): HeadersInterface
    {
        return $this->originalRequest->headers();
    }

    /**
     * @return MessageContentInterface
     */
    public function messageBody(): MessageContentInterface
    {
        return $this->originalRequest->messageBody();
    }

}
