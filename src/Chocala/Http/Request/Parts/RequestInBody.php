<?php

namespace Chocala\Http\Request\Parts;

use Chocala\Base\IllegalStateException;
use InvalidArgumentException;

class RequestInBody extends MessageBody implements MessageBodyInterface
{
    public function __construct(string $contentType)
    {
        if (func_num_args() != 1) {
            throw new InvalidArgumentException('Invalid number of arguments to create a ' . __CLASS__);
        }
        $this->type = $contentType;
        $this->data = &$_REQUEST;
    }

    /**
     * @return array
     * @throws IllegalStateException
     */
    public function data(): array
    {
        if ($this->data === null) {
            throw new IllegalStateException('Data resource is null ' . __CLASS__);
        }
        return $this->data;
    }
}
