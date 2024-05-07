<?php

namespace Chocala\Http\Request\Parts;

use Chocala\Base\IllegalArgumentException;

class MessageBody implements MessageBodyInterface
{
    /**
     * @var string
     */
    protected string $type;

    /**
     * @var mixed
     */
    protected $data;

    /**
     * MessageBody constructor.
     * @param string $type
     * @param $data
     * @throws IllegalArgumentException
     */
    public function __construct(string $type, $data)
    {
        if ($data === null) {
            throw new IllegalArgumentException('Invalid \'body\' parameter, value can\'t be null');
        }
        $this->type = $type;
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function type(): string
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function data()
    {
        return $this->data;
    }
}
