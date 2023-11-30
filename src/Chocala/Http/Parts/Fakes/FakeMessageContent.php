<?php

namespace Chocala\Http\Parts\Fakes;

use Chocala\Http\Parts\MessageContent;
use Chocala\System\ContentType;

class FakeMessageContent extends MessageContent
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
