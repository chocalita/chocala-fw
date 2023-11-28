<?php

namespace Chocala\Http\Fakes;

use Chocala\Http\Parts\Fakes\FakeHeaders;
use Chocala\Http\Parts\Fakes\FakeMessageContent;
use Chocala\Http\Parts\Fakes\FakeRequestLine;
use Chocala\Http\Parts\HeadersInterface;
use Chocala\Http\Parts\MessageContentInterface;
use Chocala\Http\Parts\RequestLineInterface;
use Chocala\Http\RequestInterface;

class FakeRequest implements RequestInterface
{

    private RequestLineInterface $fakeRequestLine;
    private HeadersInterface $fakeHeaders;
    private MessageContentInterface $fakeMessageBody;

    public function __construct()
    {
        $this->fakeRequestLine = new FakeRequestLine();
        $this->fakeHeaders = new FakeHeaders();
        $this->fakeMessageBody = new FakeMessageContent();
    }

    public function requestLine(): RequestLineInterface
    {
        return $this->fakeRequestLine;
    }

    public function headers(): HeadersInterface
    {
        return $this->fakeHeaders;
    }

    public function messageBody(): MessageContentInterface
    {
        return $this->fakeMessageBody;
    }

}
