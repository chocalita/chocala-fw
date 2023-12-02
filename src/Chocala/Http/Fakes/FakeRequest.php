<?php

namespace Chocala\Http\Fakes;

use Chocala\Http\Parts\Fakes\FakeHeaders;
use Chocala\Http\Parts\Fakes\FakeMessageBody;
use Chocala\Http\Parts\Fakes\FakeRequestData;
use Chocala\Http\Parts\Fakes\FakeRequestLine;
use Chocala\Http\Parts\HeadersInterface;
use Chocala\Http\Parts\MessageBodyInterface;
use Chocala\Http\Parts\RequestDataInterface;
use Chocala\Http\Parts\RequestLineInterface;
use Chocala\Http\RequestInterface;

class FakeRequest implements RequestInterface
{

    private RequestLineInterface $fakeRequestLine;
    private HeadersInterface $fakeHeaders;
    private RequestDataInterface $fakeRequestContent;
    private MessageBodyInterface $fakeMessageBody;

    public function __construct()
    {
        $this->fakeRequestLine = new FakeRequestLine();
        $this->fakeHeaders = new FakeHeaders();
        $this->fakeRequestContent = new FakeRequestData();
        $this->fakeMessageBody = new FakeMessageBody();
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

    public function messageBody(): MessageBodyInterface
    {
        return $this->fakeMessageBody;
    }

}
