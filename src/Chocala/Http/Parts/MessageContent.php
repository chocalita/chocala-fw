<?php

namespace Chocala\Http\Parts;

use Chocala\Base\IllegalArgumentException;

class MessageContent implements MessageContentInterface
{

    /**
     * @var string
     */
    private string $type;

    /**
     * @var mixed
     */
    private $data;

    /**
     * MessageBody constructor.
     * @param string $type
     * @param $data
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