<?php

namespace Chocala\Http\Request\Parts;

use Chocala\Base\IllegalArgumentException;
use Chocala\Http\Headers;
use Chocala\Http\HeadersInterface;

/**
 * Class RequestHeader
 * @package Chocala\Http\Request\Parts
 *
 *
 * In addition, CORS defines a subset of request headers as simple headers, request headers that are
 * always considered authorized and are not explicitly listed in responses to preflight requests.
 * https://developer.mozilla.org/en-US/docs/Glossary/CORS
 */
class RequestHeaders implements RequestHeadersInterface
{
    /**
     * @var HeadersInterface
     */
    private HeadersInterface $headers;

    public function __construct(array $headersList)
    {
        $this->headers = new Headers(
            $headersList,
            array_merge(
                array_merge(Headers::GENERAL_KEYS, Headers::ENTITY_KEYS),
                Headers::REQUEST_KEYS
            )
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
