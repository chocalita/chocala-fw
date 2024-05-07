<?php

namespace Chocala\Http\Response\Parts;

interface ResponseBodyInterface
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
