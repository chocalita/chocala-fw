<?php

namespace Chocala\Http\Request\Parts\Fakes;

use Chocala\Http\Request\Parts\JsonMessageBody;
use Chocala\Http\Request\Parts\MessageBodyInterface;

class FakeJsonMessageBody extends JsonMessageBody implements MessageBodyInterface
{
    public const DEFAULT_DATA = '{
            "key": "value"
        }';

    public function __construct()
    {
        parent::__construct(
            self::DEFAULT_DATA
        );
    }
}
