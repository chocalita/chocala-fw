<?php

namespace Chocala\Http\Parts\Fakes;

use Chocala\Http\Parts\MessageBodyInterface;
use Chocala\Http\Parts\QueryParamsInterface;
use Chocala\Http\Parts\RequestData;
use Chocala\Http\Parts\RequestDataInterface;

class FakeRequestData implements RequestDataInterface
{

    private RequestData $requestData;

    public function __construct()
    {
        $this->requestData = new RequestData(new FakeQueryParams(), new FakeMessageBody());
    }

    public function queryParams(): QueryParamsInterface
    {
        return $this->requestData->queryParams();
    }

    public function body(): MessageBodyInterface
    {
        return $this->requestData->body();
    }

    public function data()
    {
        return $this->requestData->data();
    }

}