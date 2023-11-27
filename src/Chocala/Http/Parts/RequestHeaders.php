<?php

namespace Chocala\Http\Parts;

use Chocala\Base\IllegalArgumentException;

/**
 * Class RequestHeader
 * @package Chocala\Http
 *
 *
 * In addition, CORS defines a subset of request headers as simple headers, request headers that are
 * always considered authorized and are not explicitly listed in responses to preflight requests.
 * https://developer.mozilla.org/en-US/docs/Glossary/CORS
 */
class RequestHeaders implements HeadersInterface
{

    /**
     * @var Headers
     */
    private $headers;

    public function __construct(array $headersList)
    {
        $this->headers = new Headers($headersList, array_merge(
                array_merge(Headers::GENERAL_KEYS, Headers::ENTITY_KEYS),
                Headers::REQUEST_KEYS)
        );
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function header(string $name)
    {
        return $this->headers->header($name);
    }

    /**
     * @return array
     */
    public function headerList(): array
    {
        return $this->headers->headerList();
    }

    /**
     * @param string $type
     * @return array
     */
    public function headersType(string $type): array
    {
        if ($type == Headers::TYPE_RESPONSE) {
            throw new IllegalArgumentException(sprintf('Illegal type \'%s\' in \'%s\' class', $type, __CLASS__));
        }
        return $this->headers->headersType($type);
    }

}