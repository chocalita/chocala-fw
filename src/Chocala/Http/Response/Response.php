<?php

namespace Chocala\Http\Response;

use Chocala\Http\Response\Parts\ResponseBodyInterface;
use Chocala\Http\Response\Parts\ResponseHeadersInterface;
use Chocala\Http\Response\Parts\StatusCodeEnum;
use Chocala\Http\ResponseInterface;

class Response implements ResponseInterface
{
    /**
     * Represents the StatusLine for HTTP Responses (contains status code and status message)
     *
     * @var StatusCodeEnum
     */
    private StatusCodeEnum $statusCode;

    /**
     * @var ResponseHeadersInterface
     */
    private ResponseHeadersInterface $headers;

    /**
     * @var ResponseBodyInterface
     */
    private ResponseBodyInterface $body;

    /**
     * @param StatusCodeEnum $statusCode
     * @param ResponseHeadersInterface $headers
     * @param ResponseBodyInterface $body
     */
    public function __construct(
        StatusCodeEnum           $statusCode,
        ResponseHeadersInterface $headers,
        ResponseBodyInterface    $body
    )
    {
        $this->statusCode = $statusCode;
        $this->headers = $headers;
        $this->body = $body;
    }

    /**
     * @return StatusCodeEnum
     */
    public function status(): StatusCodeEnum
    {
        return $this->statusCode;
    }

    /**
     * @return ResponseHeadersInterface
     */
    public function headers(): ResponseHeadersInterface
    {
        return $this->headers;
    }

    /**
     * @return ResponseBodyInterface
     */
    public function body(): ResponseBodyInterface
    {
        return $this->body;
    }
}
