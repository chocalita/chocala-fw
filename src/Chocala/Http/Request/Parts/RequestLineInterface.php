<?php

namespace Chocala\Http\Request\Parts;

interface RequestLineInterface
{

    /**
     * @return string
     */
    public function method(): string;

    /**
     * @return string
     */
    public function requestUri(): string;

    /**
     * @return string
     */
    public function httpVersion(): string;

}
