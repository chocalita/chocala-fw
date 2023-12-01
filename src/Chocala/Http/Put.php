<?php

namespace Chocala\Http;

use Chocala\Base\IllegalArgumentException;
use Chocala\Http\Parts\MessageBodyInterface;
use Chocala\Http\Parts\PostFormDataBody;
use Chocala\Http\Parts\QueryParams;
use Chocala\Http\Parts\QueryParamsInterface;

/**
 * Description of Put
 *
 * @author ypra
 */
class Put implements HttpMethodInterface
{
    use HttpMethodTrait;

    /**
     * @var MessageBodyInterface
     */
    private MessageBodyInterface $messageContent;

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

    private function __constructor(QueryParamsInterface $queryParams, MessageBodyInterface $messageContent)
    {
        $this->name = HttpMethod::PUT;
        $this->id = $this->generateId();
        $this->queryParams = $queryParams;
        if ($messageContent instanceof PostFormDataBody) {
            throw new IllegalArgumentException('PUT method does not support $_POST body');
        }
        $this->messageContent = $messageContent;
    }

    private function __construct1(MessageBodyInterface $messageContent)
    {
        return $this->__constructor(new QueryParams(), $messageContent);
    }

    private function __construct2(QueryParamsInterface $queryParams, MessageBodyInterface $messageContent)
    {
        return $this->__constructor($queryParams, $messageContent);
    }

    /**
     * @return mixed
     */
    public function data()
    {
        return $this->messageContent->data();
    }

}