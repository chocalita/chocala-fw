<?php

namespace Chocala\Http;

use Chocala\Http\Response\Parts\ResponseHeadersInterface;

interface ResponseInterface
{

    /**
     * @return ResponseHeadersInterface
     */
    public function headers(): ResponseHeadersInterface;

}
