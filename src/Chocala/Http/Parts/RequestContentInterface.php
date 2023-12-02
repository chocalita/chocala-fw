<?php

namespace Chocala\Http\Parts;

interface RequestContentInterface
{

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