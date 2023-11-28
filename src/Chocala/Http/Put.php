<?php

namespace Chocala\Http;

use Chocala\Http\Parts\MessageContentInterface;
use Chocala\Http\Parts\QueryParams;
use Chocala\Http\Parts\QueryParamsInterface;
use Exception;

/**
 * Description of Put
 *
 * @author ypra
 */
class Put implements HttpMethodInterface
{
    use HttpMethodTrait;

    /**
     * @var MessageContentInterface
     */
    private MessageContentInterface $messageContent;

    /**
     * Represents a unique instance for the class in the system
     * @deprecated Deprecated since version 3.0
     * @var Put|null
     */
    private static ?Put $instance = null;

    /**
     * A single class instance from this
     * @return Put
     * @deprecated Deprecated since version 3.0
     */
    public static function instance(): Put
    {
        if (!is_object(static::$instance)) {
            static::$instance = new self();
        }
        return static::$instance;
    }

    public function __construct()
    {
        $get_arguments = func_get_args();
        $number_of_arguments = func_num_args();
        if (method_exists($this, $method_name = '__construct' . $number_of_arguments)) {
            call_user_func_array([$this, $method_name], $get_arguments);
        } else {
            throw new \InvalidArgumentException('Invalid arguments to create object ' . __CLASS__);
        }
    }

    private function __constructor(QueryParamsInterface $queryParams, MessageContentInterface $messageContent)
    {
        $this->name = HttpMethod::PUT;
        $this->id = $this->generateId();
        $this->queryParams = $queryParams;
        $this->messageContent = $messageContent;
    }

    private function __construct1(MessageContentInterface $messageContent)
    {
        return $this->__constructor(new QueryParams(), $messageContent);
    }

    private function __construct2(QueryParamsInterface $queryParams, MessageContentInterface $messageContent)
    {
        return $this->__constructor($queryParams, $messageContent);
    }

    /**
     * @return MessageContentInterface
     */
    public function content() : MessageContentInterface
    {
        return $this->messageContent;
    }

    /**
     * @return mixed
     */
    public function data()
    {
        return $this->messageContent->data();
    }

}