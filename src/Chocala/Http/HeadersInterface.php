<?php

namespace Chocala\Http;

interface HeadersInterface
{
    /**
     * @param string $name
     * @return mixed
     */
    public function header(string $name);

    /**
     * @return array
     */
    public function headerList(): array;

    /**
     * @param string $type
     * @return array
     */
    public function headersType(string $type): array;
}
