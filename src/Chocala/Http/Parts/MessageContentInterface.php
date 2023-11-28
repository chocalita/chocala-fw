<?php

namespace Chocala\Http\Parts;

interface MessageContentInterface
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