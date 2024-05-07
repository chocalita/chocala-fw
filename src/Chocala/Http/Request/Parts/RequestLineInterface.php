<?php

namespace Chocala\Http\Request\Parts;

use Chocala\Http\HttpMethodEnum;

interface RequestLineInterface
{
    /**
     * @return HttpMethodEnum
     */
    public function method(): HttpMethodEnum;

    /**
     * @return string
     */
    public function requestUri(): string;

    /**
     * @return string
     */
    public function httpVersion(): string;
}
