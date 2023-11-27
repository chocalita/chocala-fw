<?php

namespace Chocala\Http;

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
     * @var Get
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
        $this->name = HttpMethod::GET;
        $this->id = $this->generateId();
        $this->data = &$_GET;
    }

    /**
     * @return mixed|void
     * @throws Exception
     */
    public function body()
    {
        throw new Exception('GET method has not a body');
    }

}