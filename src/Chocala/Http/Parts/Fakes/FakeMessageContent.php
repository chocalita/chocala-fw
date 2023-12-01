<?php

namespace Chocala\Http\Parts\Fakes;

use Chocala\Http\Parts\MessageBody;
use Chocala\System\ContentType;

class FakeMessageContent extends MessageBody
{

    public const DEFAULT_DATA = '';

    /**
     * @param mixed $dataContent
     */
    public function __construct($dataContent = self::DEFAULT_DATA)
    {
        parent::__construct(ContentType::TEXT_PLAIN, $dataContent);
    }

}
