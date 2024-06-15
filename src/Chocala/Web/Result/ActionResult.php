<?php

namespace Chocala\Web\Result;

use Chocala\Http\Response\Parts\ResponseBody;
use Chocala\Http\Response\Parts\ResponseBodyInterface;
use Chocala\Http\Response\Parts\StatusCodeEnum;
use InvalidArgumentException;

class ActionResult implements ActionResultInterface
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

    private function __constructor(
        StatusCodeEnum         $statusCode,
        ResultHeadersInterface $headers,
        ResponseBodyInterface  $body
    )
    {
        $this->statusCode = $statusCode;
        $this->headers = $headers;
        $this->body = $body;
    }

    private function __construct2(ActionResultInterface $actionResult, $data)
    {
        $this->__constructor(
            $actionResult->status(),
            $actionResult->headers(),
            // TODO: check if should be send the content type info (here is empty '')
            new ResponseBody('', $data)
        );

    }

    private function __construct3(
        StatusCodeEnum         $statusCode,
        ResultHeadersInterface $headers,
        ResponseBodyInterface  $body
    ) {
        $this->__constructor($statusCode, $headers, $body);
    }

    public function body(): ResponseBodyInterface
    {
        return $this->body;
    }
}
