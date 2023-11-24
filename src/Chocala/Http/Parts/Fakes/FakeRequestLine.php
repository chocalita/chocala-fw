<?php

namespace Chocala\Http\Parts\Fakes;

use Chocala\Http\HttpMethod;
use Chocala\Http\Parts\RequestLineInterface;

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