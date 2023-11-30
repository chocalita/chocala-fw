<?php

namespace Chocala\Http\Parts;

use Chocala\System\ContentType;
use InvalidArgumentException;

abstract class FormDataContent extends MessageContent implements MessageContentInterface
{

    public function __construct()
    {
        $this->type = ContentType::MULTIPART_FORM_DATA;
    }

    /**
     * @return array
     */
    public function data() : array
    {
        return $this->data;
    }

}