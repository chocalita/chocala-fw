<?php

namespace Chocala\Web\Result;

use Chocala\Http\Headers;
use Chocala\Http\Response\Parts\StatusCode;

trait ActionResultTrait
{

    protected StatusCode $statusCode;

    //TODO: change this with a subtype of ResponseHeaders
    protected Headers $headers;

    public function status(): StatusCode
    {
        return $this->statusCode;
    }

    public function headers(): Headers
    {
        return $this->headers;
    }

}