<?php

namespace Chocala\Http;

use Chocala\Http\Response\Parts\ResponseBodyInterface;
use Chocala\Http\Response\Parts\ResponseHeadersInterface;
use Chocala\Http\Response\Parts\StatusCodeInterface;

interface ResponseInterface
{

    /**
     * @return StatusCodeInterface
     */
    public function status() : StatusCodeInterface;

    /**
     * @return ResponseHeadersInterface
     */
    public function headers() : ResponseHeadersInterface;

    /**
     * @return ResponseBodyInterface
     */
    public function body() : ResponseBodyInterface;

}
