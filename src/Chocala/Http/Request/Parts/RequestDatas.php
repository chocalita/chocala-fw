<?php

namespace Chocala\Http\Request\Parts;

use Chocala\Http\HttpMethodEnum;
use InvalidArgumentException;

class RequestDatas
{

    public function __construct()
    {
    }

    /**
     * @throws InvalidArgumentException
     */
    public function make(HttpMethodEnum       $httpMethod,
                         QueryParamsInterface $queryParams,
                         MessageBodyInterface $messageBody) : RequestDataInterface
    {
        if ($httpMethod->isSafe()) {
            return new RequestDataNoBody($queryParams);
        } else {
            return new RequestData($queryParams, $messageBody);
        }
    }

}