<?php

namespace Chocala\Http;

use Chocala\Http\Response\Parts\ResponseBodyInterface;
use Chocala\Http\Response\Parts\ResponseHeadersInterface;
use Chocala\Http\Response\Parts\StatusCodeEnum;

interface ResponseInterface
{
    /**
     * @return StatusCodeEnum
     */
    public function status(): StatusCodeEnum;

    /**
     * @return ResponseHeadersInterface
     */
    public function headers(): ResponseHeadersInterface;

    /**
     * @return ResponseBodyInterface
     */
    public function body(): ResponseBodyInterface;
}
