<?php

namespace Chocala\Http;

use Chocala\Http\Parts\MessageBodyInterface;
use Chocala\Http\Parts\QueryParamsInterface;

interface HttpMethodInterface
{

    /**
     * @return string
     */
    public function name(): string;

    /**
     * @return QueryParamsInterface
     */
    public function queryParams(): QueryParamsInterface;

    /**
     * @return MessageBodyInterface
     */
    public function body() : MessageBodyInterface;

    /**
     * @return mixed
     */
    public function data();

}