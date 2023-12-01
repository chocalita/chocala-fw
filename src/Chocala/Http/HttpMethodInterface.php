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
     * @return string
     */
    public function id(): string;

    /**
     * @return QueryParamsInterface
     */
    public function queryParams(): QueryParamsInterface;

    /**
     * @return MessageBodyInterface
     */
    public function content() : MessageBodyInterface;

    /**
     * @return mixed
     */
    public function data();

}