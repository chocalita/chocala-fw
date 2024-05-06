<?php

namespace Chocala\Http\Fakes;

use Chocala\Http\HeadersInterface;
use Chocala\Http\Request\Parts\Fakes\FakeRequestData;
use Chocala\Http\Request\Parts\Fakes\FakeRequestHeaders;
use Chocala\Http\Request\Parts\Fakes\FakeRequestLine;
use Chocala\Http\Request\Parts\RequestDataInterface;
use Chocala\Http\Request\Parts\RequestLineInterface;
use Chocala\Http\Request\Request;
use Chocala\Http\RequestInterface;

class FakeRequest extends Request implements RequestInterface
{

    public function __construct(?RequestLineInterface $requestLine = null,
                                ?HeadersInterface     $headers = null,
                                ?RequestDataInterface $requestData = null
    )
    {
        parent::__construct(
            $requestLine?: new FakeRequestLine(),
            $headers?: new FakeRequestHeaders(),
            $requestData?: new FakeRequestData()
        );
    }


}
