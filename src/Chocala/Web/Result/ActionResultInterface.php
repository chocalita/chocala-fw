<?php

namespace Chocala\Web\Result;

use Chocala\Http\Response\Parts\StatusCodeEnum;

interface ActionResultInterface
{

    public function status(): StatusCodeEnum;

    public function headers(): ResultHeadersInterface;

    public function result(ActionDataInterface $data);

}