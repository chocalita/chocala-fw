<?php

namespace Chocala\Http\Request\Parts;

interface MessageBodyInterface
{
    /**
     * @return string
     */
    public function type(): string;

    /**
     * @return mixed
     */
    public function data();
}
