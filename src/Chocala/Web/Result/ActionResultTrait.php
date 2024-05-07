<?php

namespace Chocala\Web\Result;

use Chocala\Http\Response\Parts\ResponseBodyInterface;
use Chocala\Http\Response\Parts\StatusCodeEnum;

trait ActionResultTrait
{
    protected StatusCodeEnum $statusCode;

    protected ResultHeadersInterface $headers;

    protected ResponseBodyInterface $body;

    public function status(): StatusCodeEnum
    {
        return $this->statusCode;
    }

    public function headers(): ResultHeadersInterface
    {
        return $this->headers;
    }
}
