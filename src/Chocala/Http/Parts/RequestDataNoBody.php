<?php

namespace Chocala\Http\Parts;

use Chocala\Base\UnsupportedOperationException;
use Chocala\Http\Method\HttpMethodTrait;
use Exception;

/**
 * Description of Get
 *
 * @author ypra
 */
class RequestDataNoBody implements RequestDataInterface
{
    use HttpMethodTrait;

    /**
     * Represents a unique instance for the class in the system
     * @deprecated Deprecated since version 3.0
     * @var RequestDataNoBody|null
     */
    private static ?RequestDataNoBody $instance = null;

    /**
     * A single class instance from this
     * @return RequestDataNoBody
     *@deprecated Deprecated since version 3.0
     */
    public static function instance(): RequestDataNoBody
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
            throw new \InvalidArgumentException('Invalid number of arguments to create object ' . __CLASS__);
        }
    }

    /**
     * @throws Exception
     */
    private function __constructor(QueryParamsInterface $queryParams)
    {
        $this->queryParams = $queryParams;
    }

    private function __construct0()
    {
        $this->__constructor(new QueryParams());
    }

    private function __construct1(QueryParamsInterface $queryParams)
    {
        $this->__constructor($queryParams);
    }

    /**
     * @return MessageBodyInterface
     * @throws Exception
     */
    public function body() : MessageBodyInterface
    {
        throw new UnsupportedOperationException('Safe HTTP method does not support body content');
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