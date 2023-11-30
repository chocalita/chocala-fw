<?php

namespace Chocala\Http\Parts\Fakes;

use Chocala\Http\Parts\JsonMessageContent;

class FakeJsonMessageContent extends JsonMessageContent
{

    public const DEFAULT_DATA = '{
            "key": "value"
        }';

    public function __construct()
    {
        parent::__construct(self::DEFAULT_DATA);
    }

}