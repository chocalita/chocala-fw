<?php

namespace Chocala\Http\Parts\Fakes;

use Chocala\Http\Parts\MessageBodyInterface;
use Chocala\System\ContentType;

class FakeMessageBody implements MessageBodyInterface
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
    public function body()
    {
        return '';
    }

}
