<?php

namespace Chocala\Web\Result;

use Chocala\Http\Headers;
use Chocala\Http\Response\Parts\StatusCode;

interface ActionResultInterface
{

    public function status(): StatusCode;

    public function headers(): Headers;

    public function result(ActionData $data);

}