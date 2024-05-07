<?php

namespace Chocala\Http\Request;

use Chocala\Http\Request\Parts\RequestDataInterface;
use Chocala\Http\Request\Parts\RequestHeadersInterface;
use Chocala\Http\Request\Parts\RequestLineInterface;
use Chocala\Http\RequestInterface;
use Exception;

class Request implements RequestInterface
{
    /**
     * @var RequestLineInterface
     */
    protected RequestLineInterface $requestLine;

    /**
     * @var RequestHeadersInterface
     */
    protected RequestHeadersInterface $headers;

    /**
     * @var RequestDataInterface
     */
    protected RequestDataInterface $requestData;

    /**
     * Request constructor.
     * @param RequestLineInterface $requestLine
     * @param RequestHeadersInterface $headers
     * @param RequestDataInterface $requestData
     */
    public function __construct(
        RequestLineInterface    $requestLine,
        RequestHeadersInterface $headers,
        RequestDataInterface    $requestData
    )
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
     * @return RequestHeadersInterface
     */
    public function headers(): RequestHeadersInterface
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
