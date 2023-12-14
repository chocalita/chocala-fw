<?php

namespace Chocala\Http;

use Chocala\Http\IO\InputStream;
use Chocala\Http\Request\Parts\MessageBodies;
use Chocala\Http\Request\Parts\QueryParams;
use Chocala\Http\Request\Parts\RequestDataNoBody;
use Chocala\Http\Request\Parts\RequestDatas;
use Chocala\Http\Request\Parts\RequestHeaders;
use Chocala\Http\Request\Request;

class Requests
{

    private array $serverVars;
    private array $requestVars;

    public function __construct()
    {
        $this->serverVars = &$_SERVER;
        $this->requestVars = &$_REQUEST;
    }

    public function make() : RequestInterface
    {
        $httpMethod = (new HttpMethods())->make($this->serverVars['REQUEST_METHOD']);

        $requestLine = new RequestLine(
            $httpMethod,
            $this->serverVars['REQUEST_URI'],
            $this->serverVars['SERVER_PROTOCOL']
        );

        $headers = new RequestHeaders(getallheaders());

        //$contentType = $headers->header(Headers::CONTENT_TYPE_KEY);

        $messageBody = (new MessageBodies())->make(
            $httpMethod,
            $headers,
            new InputStream()
        );

        $requestData = (new RequestDatas())->make(
            $httpMethod,
            new QueryParams(),
            $messageBody
        );

        return new Request(
            $requestLine,
            $headers,
            $requestData
        );

    }

}