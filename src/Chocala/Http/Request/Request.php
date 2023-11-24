<?php

namespace Chocala\Http\Request;

use Chocala\Http\Parts\HeadersInterface;
use Chocala\Http\Parts\MessageBodyInterface;
use Chocala\Http\Parts\RequestLineInterface;
use Chocala\Http\RequestInterface;

class Request implements RequestInterface
{

    /**
     * @var RequestLineInterface
     */
    private $requestLine;

    /**
     * @var HeadersInterface
     */
    private $headers;

    /**
     * @var MessageBodyInterface
     */
    private $messageBody;

    /**
     * Request constructor.
     * @param RequestLineInterface $requestLine
     * @param HeadersInterface $headers
     * @param MessageBodyInterface $messageBody
     */
    public function __construct(RequestLineInterface $requestLine, HeadersInterface $headers, MessageBodyInterface $messageBody)
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
     * @return MessageBodyInterface
     */
    public function messageBody(): MessageBodyInterface
    {
        return $this->messageBody;
    }

}
