<?php

namespace Chocala\Http;

/**
 * Description of Put
 *
 * @author ypra
 */
class Put implements HttpMethodInterface
{
    use HttpMethodTrait;

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

    /**
     * @throws \Exception
     */
    public function __construct()
    {
        $this->name = HttpMethod::PUT;
        $this->id = $this->generateId();
        $this->data = &$_PUT;
    }

}