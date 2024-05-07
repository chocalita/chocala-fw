<?php

namespace Chocala\Http;

use Chocala\Http\Request\Parts\QueryParams;
use Chocala\Http\Request\Parts\RequestDatas;
use Chocala\Http\Request\Parts\RequestHeaders;
use Chocala\Http\Request\Parts\RequestLine;
use Chocala\Http\Request\Request;

class Requests
{
    private array $serverVars;

    public function __construct()
    {
        $this->serverVars = &$_SERVER;
    }

    public function make(): RequestInterface
    {
        $httpMethod = (new HttpMethods())->make($this->serverVars['REQUEST_METHOD']);

        $requestLine = new RequestLine(
            $httpMethod,
            $this->serverVars['REQUEST_URI'],
            $this->serverVars['SERVER_PROTOCOL']
        );

        $requestHeaders = new RequestHeaders(getallheaders());

        $requestData = (new RequestDatas())->make(
            $httpMethod,
            $requestHeaders,
            new QueryParams()
        );

        return new Request(
            $requestLine,
            $requestHeaders,
            $requestData
        );
    }
}
