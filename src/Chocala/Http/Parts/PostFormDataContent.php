<?php

namespace Chocala\Http\Parts;

use Chocala\Base\IllegalStateException;
use Chocala\System\ContentType;
use InvalidArgumentException;

class PostFormDataContent extends MessageContent implements MessageContentInterface
{

    public function __construct()
    {
        if (func_num_args() > 0) {
            throw new InvalidArgumentException('Too many arguments to create object ' . __CLASS__);
        }
        $this->type = ContentType::MULTIPART_FORM_DATA;
        $this->data = &$_POST;
    }

    /**
     * @return array
     * @throws IllegalStateException
     */
    public function data() : array
    {
        if ($this->data === null ) {
            throw new IllegalStateException('Data resource is null ' . __CLASS__);
        }
        return $this->data;
    }

}