<?php

namespace Chocala\Http\Parts\Fakes;

use Chocala\Http\Parts\MessageContentInterface;
use Chocala\System\ContentType;

class FakeMessageContent implements MessageContentInterface
{

    /**
     * @inheritDoc
     */
    public function type(): string
    {
        return ContentType::TEXT_PLAIN;
    }

    /**
     * @inheritDoc
     */
    public function data()
    {
        return '';
    }

}
