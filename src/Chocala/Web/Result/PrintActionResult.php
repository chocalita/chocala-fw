<?php

namespace Chocala\Web\Result;

use Chocala\Http\Response\Parts\StatusCode;

class PrintActionResult implements ActionResultInterface
{
    use ActionResultTrait;

    public function __construct(StatusCode $statusCode, ResultHeaders $headers = null)
    {
        $this->statusCode = $statusCode;
        $this->headers = $headers ?? new ResultHeaders();
    }

    public function result(ActionDataInterface $data)
    {
        return print_r($data->vars(), true);
    }

}