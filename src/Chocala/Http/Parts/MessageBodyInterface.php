<?php

namespace Chocala\Http\Parts;

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