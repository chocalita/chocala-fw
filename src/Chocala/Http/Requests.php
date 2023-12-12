<?php

namespace Chocala\Http;

use Chocala\Http\Request\Parts\RequestDataNoBody;
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

        if ($httpMethod->isSafe()) {
            $requestData = new RequestDataNoBody(

            );
        }  else {
            $requestData = new FakeRequestData(

            );
        }

        return new Request(
            $requestLine,
            $headers,
            $requestData
        );

    }

}