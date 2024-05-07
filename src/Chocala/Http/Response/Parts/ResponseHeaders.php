<?php

namespace Chocala\Http\Response\Parts;

use Chocala\Base\IllegalArgumentException;
use Chocala\Http\Headers;
use Chocala\Http\HeadersInterface;

class ResponseHeaders implements ResponseHeadersInterface
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
                Headers::RESPONSE_KEYS
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
        if ($type == Headers::TYPE_REQUEST) {
            throw new IllegalArgumentException(sprintf('Illegal type \'%s\' in \'%s\' class', $type, __CLASS__));
        }
        return $this->headers->headersType($type);
    }
}
