<?php

namespace Chocala\Web\Result;

use Chocala\Http\Response\Parts\StatusCode;
use Chocala\Http\Response\Parts\StatusCodeEnum;

class DefaultActionResult implements ActionResultInterface
{

    private ActionResultInterface $actionResult;

    public function __construct()
    {
        $this->actionResult = new JsonActionResult(
            StatusCode::OK(),
            new ResultHeaders()
        );

    }

    public function status(): StatusCodeEnum
    {
        return $this->actionResult->status();
    }

    public function headers(): ResultHeadersInterface
    {
        return $this->actionResult->headers();
    }

    public function result(ActionDataInterface $data)
    {
        return $this->actionResult->result($data);
    }

}