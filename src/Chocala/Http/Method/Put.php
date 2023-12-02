<?php

namespace Chocala\Http\Method;

use Chocala\Base\IllegalArgumentException;
use Chocala\Http\HttpMethod;
use Chocala\Http\HttpMethodInterface;
use Chocala\Http\Parts\MessageBodyInterface;
use Chocala\Http\Parts\PostFormDataBody;
use Chocala\Http\Parts\QueryParams;
use Chocala\Http\Parts\QueryParamsInterface;

/**
 * Description of Put
 *
 * @author ypra
 */
class Put //implements HttpMethodInterface
{
    use HttpMethodTrait;

    public function __construct()
    {
        $get_arguments = func_get_args();
        $number_of_arguments = func_num_args();
        if (method_exists($this, $method_name = '__construct' . $number_of_arguments)) {
            call_user_func_array([$this, $method_name], $get_arguments);
        } else {
            throw new \InvalidArgumentException('Invalid number of arguments to create object ' . __CLASS__);
        }
    }

    private function __constructor(QueryParamsInterface $queryParams, MessageBodyInterface $messageBody)
    {
        $this->name = HttpMethod::PUT;
        $this->queryParams = $queryParams;
        if ($messageBody instanceof PostFormDataBody) {
            throw new IllegalArgumentException('PUT method does not support $_POST body');
        }
        $this->messageBody = $messageBody;
    }

    private function __construct1(MessageBodyInterface $messageBody)
    {
        return $this->__constructor(new QueryParams(), $messageBody);
    }

    private function __construct2(QueryParamsInterface $queryParams, MessageBodyInterface $messageBody)
    {
        return $this->__constructor($queryParams, $messageBody);
    }

    /**
     * @return mixed
     */
    public function data()
    {
        return $this->messageBody->data();
    }

}