<?php

namespace Chocala\Http;

use Chocala\Base\IllegalArgumentException;
use Chocala\Http\Parts\MessageBodyInterface;
use Chocala\Http\Parts\QueryParams;
use Chocala\Http\Parts\QueryParamsInterface;
use Chocala\Http\Parts\RawFormDataBody;

/**
 * Description of Post
 *
 * @author ypra
 */
class Post implements HttpMethodInterface
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
        $this->name = HttpMethod::POST;
        $this->queryParams = $queryParams;
        if ($messageBody instanceof RawFormDataBody) {
            throw new IllegalArgumentException('POST method does not support raw-data body');
        }
        $this->messageBody = $messageBody;
    }

    private function __construct1(MessageBodyInterface $messageBody)
    {
        $this->__constructor(new QueryParams(), $messageBody);
    }

    private function __construct2(QueryParamsInterface $queryParams, MessageBodyInterface $messageBody)
    {
        $this->__constructor($queryParams, $messageBody);
    }

    /**
     * @return mixed
     */
    public function data()
    {
        return $this->messageBody->data();
    }

}