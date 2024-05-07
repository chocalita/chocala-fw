<?php

namespace Chocala\Web\Result\Fakes;

use Chocala\Web\Result\ResultHeaders;
use Chocala\Web\Result\ResultHeadersInterface;

class FakeResultHeaders implements ResultHeadersInterface
{
    public const DEFAULT_DATA = [
        'fooHeader' => 'one',
        'barHeader' => 'two'
    ];

    private ResultHeadersInterface $resultHeaders;

    /**
     * @param array $vars
     */
    public function __construct(array $vars = self::DEFAULT_DATA)
    {
        $this->resultHeaders = new ResultHeaders($vars);
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function header(string $name)
    {
        return $this->resultHeaders->header($name);
    }

    /**
     * @return array
     */
    public function headerList(): array
    {
        return $this->resultHeaders->headerList();
    }

    /**
     * @param string $type
     * @return array
     */
    public function headersType(string $type): array
    {
        return $this->resultHeaders->headersType($type);
    }

    /**
     * @param string $key
     * @param $value
     * @return void
     */
    public function addHeader(string $key, $value): void
    {
        $this->resultHeaders->addHeader($key, $value);
    }
}
