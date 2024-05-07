<?php

namespace Chocala\Http\Request\Parts;

use Chocala\System\ContentType;

abstract class FormDataBody extends MessageBody implements MessageBodyInterface
{
    public function __construct(array $data)
    {
        parent::__construct(
            ContentType::MULTIPART_FORM_DATA,
            $data
        );
    }

    /**
     * @return array
     */
    public function data(): array
    {
        return $this->data;
    }
}
