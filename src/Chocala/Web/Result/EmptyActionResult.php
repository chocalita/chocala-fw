<?php

namespace Chocala\Web\Result;

use Chocala\Base\ChocalaException;
use Chocala\Base\UnsupportedOperationException;
use Chocala\Http\Response\Parts\ResponseBodyInterface;
use Chocala\Http\Response\Parts\StatusCodeEnum;
use InvalidArgumentException;

class EmptyActionResult implements ActionResultInterface
{
    use ActionResultTrait;

    public function __construct()
    {
        $get_arguments = func_get_args();
        $number_of_arguments = func_num_args();
        if (method_exists($this, $method_name = '__construct' . $number_of_arguments)) {
            call_user_func_array([$this, $method_name], $get_arguments);
        } else {
            throw new InvalidArgumentException('Invalid number of arguments to create object ' . __CLASS__);
        }
    }

    private function __constructor(StatusCodeEnum $statusCode, ResultHeadersInterface $headers)
    {
        $this->statusCode = $statusCode;
        $this->headers = $headers;
    }

    private function __construct1(StatusCodeEnum $statusCode)
    {
        $this->__constructor($statusCode, new ResultHeaders());
    }

    private function __construct2(StatusCodeEnum $statusCode, ResultHeadersInterface $headers)
    {
        $this->__constructor($statusCode, $headers);
    }

    public function body(): ResponseBodyInterface
    {
        throw new UnsupportedOperationException(
            'This class does not have any body, it should be filled in a concrete ActionResult'
        );
    }
}
