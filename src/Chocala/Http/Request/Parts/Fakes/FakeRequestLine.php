<?php

namespace Chocala\Http\Request\Parts\Fakes;

use Chocala\Http\HttpMethod;
use Chocala\Http\Request\Parts\RequestLineInterface;

class FakeRequestLine implements RequestLineInterface
{

    /**
     * @inheritDoc
     */
    public function method(): string
    {
        return HttpMethod::POST;
    }

    /**
     * @inheritDoc
     */
    public function requestUri(): string
    {
        return 'http://localhost:8081/api/vx/resource';
    }

    /**
     * @inheritDoc
     */
    public function httpVersion(): string
    {
        return 'HTTP/1.1';
    }

}