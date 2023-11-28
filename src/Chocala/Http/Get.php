<?php

namespace Chocala\Http;

use Chocala\Http\Parts\MessageContentInterface;
use Chocala\Http\Parts\QueryParams;
use Chocala\Http\Parts\QueryParamsInterface;
use Exception;

/**
 * Description of Get
 *
 * @author ypra
 */
class Get implements HttpMethodInterface
{
    use HttpMethodTrait;

    /**
     * Represents a unique instance for the class in the system
     * @deprecated Deprecated since version 3.0
     * @var Get|null
     */
    private static ?Get $instance = null;

    /**
     * A single class instance from this
     * @deprecated Deprecated since version 3.0
     * @return Get
     */
    public static function instance(): Get
    {
        if (!is_object(static::$instance)) {
            static::$instance = new self();
        }
        return static::$instance;
    }

    /**
     * @throws Exception
     */

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

    private function __constructor(QueryParamsInterface $queryParams)
    {
        $this->name = HttpMethod::GET;
        $this->id = $this->generateId();
        $this->queryParams = $queryParams;
    }

    private function __construct0()
    {
        return $this->__constructor(new QueryParams());
    }

    private function __construct1(QueryParamsInterface $queryParams)
    {
        return $this->__constructor($queryParams);
    }

    /**
     * @throws Exception
     */
    public function content() : MessageContentInterface
    {
        throw new Exception('GET method has not a body');
    }

    /**
     * Returns data from 'queryParam' property, it's an array. Data is taken from the QueryString found in the Url.
     * @return array
     */
    public function data(): array
    {
        return $this->queryParams->data();
    }

}