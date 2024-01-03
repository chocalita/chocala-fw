<?php

namespace Chocala\Web\Result;

use Chocala\Http\Headers;
use Chocala\Http\Response\Parts\StatusCode;

class PrintActionResult implements ActionResultInterface
{
    use ActionResultTrait;

    public function __construct(StatusCode $statusCode, Headers $headers = null)
    {
        $this->statusCode = $statusCode;
        $this->headers = $headers ?? new Headers([], []);
    }

    public function result(ActionDataInterface $data)
    {
        return print_r($data->vars(), true);
    }

}