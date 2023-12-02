<?php

namespace Chocala\Http\Parts\Fakes;

use Chocala\Http\Parts\JsonMessageBody;
use Chocala\Http\Parts\MessageBodyInterface;

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