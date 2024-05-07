<?php

namespace Chocala\Http\Request\Parts;

interface RequestDataInterface
{
    /**
     * @return QueryParamsInterface
     */
    public function queryParams(): QueryParamsInterface;

    /**
     * @return MessageBodyInterface
     */
    public function body(): MessageBodyInterface;

    /**
     * @return mixed
     */
    public function data();
}
