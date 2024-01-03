<?php

namespace Chocala\Web\Result;

use Chocala\Http\Headers;
use Chocala\Http\Response\Parts\StatusCode;

class DefaultActionResult implements ActionResultInterface
{

    private ActionResultInterface $actionResult;

    public function __construct()
    {
        $this->actionResult = new JsonActionResult(
            StatusCode::OK(),
            new Headers([], [])
        );

    }

    public function status(): StatusCode
    {
        return $this->actionResult->status();
    }

    public function headers(): Headers
    {
        return $this->actionResult->headers();
    }

    public function result(ActionData $data)
    {
        return $this->actionResult->result($data);
    }

}