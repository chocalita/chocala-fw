<?php

namespace Chocala\Web\Result;

use Chocala\Base\IllegalArgumentException;
use Chocala\Http\Headers;

class ResultHeaders extends Headers implements ResultHeadersInterface
{
    public function __construct(array $headersList = [])
    {
        parent::__construct($headersList, []);
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
        return parent::headersType($type);
    }


    public function addHeader(string $key, $value): void
    {
        $this->headers[$key] = $value;
    }
}
