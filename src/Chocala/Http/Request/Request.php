<?php

namespace Chocala\Http\Request;

use Chocala\Http\Parts\HeadersInterface;
use Chocala\Http\Parts\MessageContentInterface;
use Chocala\Http\Parts\RequestLineInterface;
use Chocala\Http\RequestInterface;

class Request implements RequestInterface
{

    /**
     * @var RequestLineInterface
     */
    private RequestLineInterface $requestLine;

    /**
     * @var HeadersInterface
     */
    private HeadersInterface $headers;

    /**
     * @var MessageContentInterface
     */
    private MessageContentInterface $messageBody;

    /**
     * Request constructor.
     * @param RequestLineInterface $requestLine
     * @param HeadersInterface $headers
     * @param MessageContentInterface $messageBody
     */
    public function __construct(RequestLineInterface $requestLine, HeadersInterface $headers, MessageContentInterface $messageBody)
    {
        $this->requestLine = $requestLine;
        $this->headers = $headers;
        $this->messageBody = $messageBody;
    }

    /**
     * @return RequestLineInterface
     */
    public function requestLine(): RequestLineInterface
    {
        return $this->requestLine;
    }

    /**
     * @return HeadersInterface
     */
    public function headers(): HeadersInterface
    {
        return $this->headers;
    }

    /**
     * @return MessageContentInterface
     */
    public function messageBody(): MessageContentInterface
    {
        return $this->messageBody;
    }

}
