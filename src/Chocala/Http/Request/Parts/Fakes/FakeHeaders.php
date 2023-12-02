<?php

namespace Chocala\Http\Request\Parts\Fakes;

use Chocala\Http\Request\Parts\Headers;
use Chocala\Http\Request\Parts\HeadersInterface;

class FakeHeaders implements HeadersInterface
{

    private Headers $header;

    public function __construct()
    {
        $this->header = new Headers([
            Headers::CONTENT_TYPE_KEY => 'application/json',
            Headers::USER_AGENT_KEY => 'Mozilla/5.0',
            Headers::ACCEPT_LANGUAGE_KEY => 'en-US;q=0.9'
        ]);
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
