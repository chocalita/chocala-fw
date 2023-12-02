<?php

namespace Chocala\Http\Parts;

interface RequestDataInterface
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