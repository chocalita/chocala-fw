<?php

namespace Chocala\Web\Result;

use Chocala\Http\Headers;
use Chocala\Http\Response\Parts\StatusCode;

class JsonActionResult implements ActionResultInterface
{
    use ActionResultTrait;

    protected StatusCode $statusCode;

    //TODO: change for subtype of ResponseHeaders
    protected Headers $headers;

    public function __construct(StatusCode $statusCode, Headers $headers = null)
    {
        $this->statusCode = $statusCode;
        $this->headers = $headers ?? new Headers([], []);
    }

    public function result(ActionDataInterface $data)
    {
        $vars = $data->vars();
        return json_encode($vars);
    }

}