<?php

namespace Chocala\Http\Parts;

use Chocala\System\ContentType;

abstract class FormDataBody extends MessageBody implements MessageBodyInterface
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