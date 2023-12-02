<?php

namespace Chocala\Http\Request;

use Chocala\Http\Parts\HeadersInterface;
use Chocala\Http\Parts\RequestDataInterface;
use Chocala\Http\Parts\RequestLineInterface;
use Chocala\Http\RequestInterface;

class Request implements RequestInterface
{

    /**
     * @var RequestLineInterface
     */
    protected RequestLineInterface $requestLine;

    /**
     * @var HeadersInterface
     */
    protected HeadersInterface $headers;

    /**
     * @var RequestDataInterface
     */
    protected RequestDataInterface $requestData;

    /**
     * Request constructor.
     * @param RequestLineInterface $requestLine
     * @param HeadersInterface $headers
     * @param RequestDataInterface $requestData
     */
    public function __construct(RequestLineInterface $requestLine, HeadersInterface $headers,
                                RequestDataInterface $requestData)
    {
        $this->requestLine = $requestLine;
        $this->headers = $headers;
        $this->requestData = $requestData;
    }

    /**
     * @return RequestLineInterface
     */
    public function requestLine(): RequestLineInterface
    {
        return $this->requestLine;
    }

    /**
     * @return HeadersInterface
     */
    public function headers(): HeadersInterface
    {
        return $this->headers;
    }

    /**
     * @return RequestDataInterface
     */
    public function requestData(): RequestDataInterface
    {
        return $this->requestData;
    }


    /**
     * @return string
     * @throws Exception
     */
    protected function generateId(): string
    {
        return time() . '-' . random_int(100000000, 999999999);
    }

}
