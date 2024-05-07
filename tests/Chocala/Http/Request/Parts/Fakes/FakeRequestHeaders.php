<?php

namespace Chocala\Http\Request\Parts\Fakes;

use Chocala\Http\Headers;
use Chocala\Http\Request\Parts\RequestHeaders;
use Chocala\Http\Request\Parts\RequestHeadersInterface;

class FakeRequestHeaders implements RequestHeadersInterface
{
    private RequestHeadersInterface $header;

    public function __construct()
    {
        $this->header = new RequestHeaders(
            [
            Headers::CONTENT_TYPE_KEY => 'application/json',
            Headers::USER_AGENT_KEY => 'Mozilla/5.0',
            Headers::ACCEPT_LANGUAGE_KEY => 'en-US;q=0.9'
            ]
        );
    }

    /**
     * @inheritDoc
     */
    public function header(string $name)
    {
        return $this->header->header($name);
    }

    /**
     * @inheritDoc
     */
    public function headerList(): array
    {
        return $this->header->headerList();
    }

    /**
     * @inheritDoc
     */
    public function headersType(string $type): array
    {
        return $this->header->headersType($type);
    }
}
