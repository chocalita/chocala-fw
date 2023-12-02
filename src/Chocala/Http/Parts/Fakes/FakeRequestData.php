<?php

namespace Chocala\Http\Parts\Fakes;

use Chocala\Http\Parts\MessageBodyInterface;
use Chocala\Http\Parts\QueryParamsInterface;
use Chocala\Http\Parts\RequestData;
use Chocala\Http\Parts\RequestDataInterface;

class FakeRequestData implements RequestDataInterface
{

    private RequestData $requestContent;

    public function __construct()
    {
        $this->requestContent = new RequestData(new FakeQueryParams(), new FakeMessageBody());
    }

    public function queryParams(): QueryParamsInterface
    {
        return $this->requestContent->queryParams();
    }

    public function body(): MessageBodyInterface
    {
        return $this->requestContent->body();
    }

    public function data()
    {
        return $this->requestContent->data();
    }

}