<?php

namespace Chocala\Web\Result;

use Chocala\Http\Response\Parts\StatusCode;
use Chocala\Http\Response\Parts\StatusCodeEnum;

trait ActionResultTrait
{

    protected StatusCode $statusCode;

    protected ResultHeadersInterface $headers;

    public function status(): StatusCodeEnum
    {
        return $this->statusCode;
    }

    public function headers(): ResultHeadersInterface
    {
        return $this->headers;
    }

}