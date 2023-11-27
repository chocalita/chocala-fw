<?php

namespace Chocala\Http\Request;

use Chocala\Base\UnsupportedOperationException;
use Chocala\Http\Parts\HeadersInterface;
use Chocala\Http\Parts\MessageBodyInterface;
use Chocala\Http\Parts\RequestLineInterface;
use Chocala\Http\RequestInterface;

class SafeMethod implements RequestInterface
{

    /**
     * @var RequestInterface
     */
    private RequestInterface $request;

    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }

    public function requestLine(): RequestLineInterface
    {
        return $this->request->requestLine();
    }

    public function headers(): HeadersInterface
    {
        return $this->request->headers();
    }

    public function messageBody(): MessageBodyInterface
    {
        throw new UnsupportedOperationException("safe method does not support message body content.");
    }

}