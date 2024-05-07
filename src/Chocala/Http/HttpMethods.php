<?php

namespace Chocala\Http;

use Chocala\Base\ChocalaException;

class HttpMethods
{
    /**
     * @param $key
     * @return HttpMethodEnum
     */
    public function make($key): HttpMethodEnum
    {
        switch (strtoupper($key)) {
            case HttpMethod::GET()->name():
                return HttpMethod::GET();

            case HttpMethod::POST()->name():
                return HttpMethod::POST();

            case HttpMethod::PUT()->name():
                return HttpMethod::PUT();

            case HttpMethod::PATCH()->name():
                return HttpMethod::PATCH();

            case HttpMethod::DELETE()->name():
                return HttpMethod::DELETE();

            case HttpMethod::OPTIONS()->name():
                return HttpMethod::OPTIONS();

            case HttpMethod::HEAD()->name():
                return HttpMethod::HEAD();

            case HttpMethod::CONNECT()->name():
                return HttpMethod::CONNECT();

            case HttpMethod::TRACE()->name():
                return HttpMethod::TRACE();

            default:
                throw new ChocalaException('Invalid Http method.', 10);
        }
    }
}
