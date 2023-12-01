<?php

namespace Chocala\Http\Parts\Fakes;

use Chocala\Http\Parts\JsonMessageBody;

class FakeJsonMessageBody extends JsonMessageBody
{

    public const DEFAULT_DATA = '{
            "key": "value"
        }';

    public function __construct()
    {
        parent::__construct(self::DEFAULT_DATA);
    }

}