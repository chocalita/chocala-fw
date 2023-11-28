<?php

namespace Chocala\Http;

use Chocala\Http\Parts\MessageContentInterface;
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
     * @return MessageContentInterface
     */
    public function content() : MessageContentInterface;

    /**
     * @return mixed
     */
    public function data();

}