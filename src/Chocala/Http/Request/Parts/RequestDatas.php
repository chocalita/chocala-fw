<?php

namespace Chocala\Http\Request\Parts;

use Chocala\Base\IllegalArgumentException;
use Chocala\Base\UnsupportedOperationException;
use Chocala\Http\Headers;
use Chocala\Http\HttpMethodEnum;
use Chocala\Http\IO\InputStream;
use InvalidArgumentException;

class RequestDatas
{

    public function __construct()
    {
    }

    /**
     * @param HttpMethodEnum $httpMethod
     * @param RequestHeadersInterface $headers
     * @param QueryParamsInterface $queryParams
     * @return RequestDataInterface
     * @throws InvalidArgumentException
     * @throws IllegalArgumentException
     * @throws UnsupportedOperationException
     */
    public function make(HttpMethodEnum       $httpMethod,
                         RequestHeadersInterface $headers,
                         QueryParamsInterface $queryParams) : RequestDataInterface
    {
        if ($httpMethod->isSafe()) {
            return new RequestDataNoBody($queryParams);
        } else {
            $contentType = $headers->header(Headers::CONTENT_TYPE_KEY);
            $messageBody = (new MessageBodies())->make(
                $httpMethod,
                $contentType,
                new InputStream()
            );
            return new RequestData($queryParams, $messageBody);
        }
    }

}