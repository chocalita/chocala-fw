<?php

namespace Chocala\Http\Parts;

use Chocala\Base\IllegalArgumentException;

class MessageBody implements MessageBodyInterface
{

    /**
     * @var string
     */
    private $type;

    /**
     * @var mixed
     */
    private $body;

    /**
     * MessageBody constructor.
     * @param string $type
     * @param $body
     */
    public function __construct(string $type, $body)
    {
        if ($body === null) {
            throw new IllegalArgumentException('Invalid \'body\' parameter');
        }
        $this->type = $type;
        $this->body = $body;
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
    public function body()
    {
        return $this->body;
    }

}