<?php

namespace Chocala\Web\Result;

use Chocala\Http\Response\Parts\StatusCodeEnum;

class JsonActionResult implements ActionResultInterface
{
    use ActionResultTrait;

    public function __construct(StatusCodeEnum $statusCode, ResultHeadersInterface $headers = null)
    {
        $this->statusCode = $statusCode;
        $this->headers = $headers ?? new ResultHeaders();
    }

    public function result(ActionDataInterface $data)
    {
        $vars = $data->vars();
        return json_encode($vars);
    }

}