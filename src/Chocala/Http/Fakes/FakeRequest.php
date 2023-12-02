<?php

namespace Chocala\Http\Fakes;

use Chocala\Http\Parts\Fakes\FakeHeaders;
use Chocala\Http\Parts\Fakes\FakeRequestData;
use Chocala\Http\Parts\Fakes\FakeRequestLine;
use Chocala\Http\Parts\HeadersInterface;
use Chocala\Http\Parts\RequestDataInterface;
use Chocala\Http\Parts\RequestLineInterface;
use Chocala\Http\RequestInterface;

class FakeRequest implements RequestInterface
{

    private RequestLineInterface $fakeRequestLine;
    private HeadersInterface $fakeHeaders;
    private RequestDataInterface $fakeRequestContent;

    public function __construct(?RequestLineInterface $fakeRequestLine,
                                ?HeadersInterface $fakeHeaders,
                                ?RequestDataInterface $fakeRequestContent
    )
    {
        $this->fakeRequestLine = $fakeRequestLine?: new FakeRequestLine();
        $this->fakeHeaders = $fakeHeaders?: new FakeHeaders();
        $this->fakeRequestContent = $fakeRequestContent?: new FakeRequestData();
    }

    public function requestLine(): RequestLineInterface
    {
        return $this->fakeRequestLine;
    }

    public function headers(): HeadersInterface
    {
        return $this->fakeHeaders;
    }

    public function requestData(): RequestDataInterface
    {
        return $this->fakeRequestContent;
    }

}
