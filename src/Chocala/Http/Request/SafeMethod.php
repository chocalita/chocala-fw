<?php

namespace Chocala\Http\Request;

use Chocala\Base\UnsupportedOperationException;
use Chocala\Http\HeadersInterface;
use Chocala\Http\Request\Parts\RequestDataInterface;
use Chocala\Http\Request\Parts\RequestDataNoBody;
use Chocala\Http\Request\Parts\RequestHeadersInterface;
use Chocala\Http\Request\Parts\RequestLineInterface;
use Chocala\Http\RequestInterface;

class SafeMethod implements RequestInterface
{
    /**
     * @var RequestInterface
     */
    private RequestInterface $request;

    public function __construct(RequestInterface $request)
    {
        if (!($request->requestData() instanceof RequestDataNoBody)) {
            throw new UnsupportedOperationException('Safe HTTP method does not support message body content.');
        }
        $this->request = $request;
    }

    public function requestLine(): RequestLineInterface
    {
        return $this->request->requestLine();
    }

    public function headers(): RequestHeadersInterface
    {
        return $this->request->headers();
    }

    public function requestData(): RequestDataInterface
    {
        return $this->request->requestData();
    }
}
