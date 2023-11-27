<?php

namespace Chocala\Http;

/**
 * Description of Post
 *
 * @author ypra
 */
class Post implements HttpMethodInterface
{
    use HttpMethodTrait;

    /**
     * Represents a unique instance for the class in the system
     * @deprecated Deprecated since version 3.0
     * @var Post
     */
    private static ?Post $instance = null;

    /**
     * A single class instance from this
     * @return Post
     * @deprecated Deprecated since version 3.0
     */
    public static function instance(): Post
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
        $this->name = HttpMethod::POST;
        $this->id = $this->generateId();
        $this->data = &$_POST;
    }

}