<?php

namespace Chocala\Http\Parts\Fakes;

use Chocala\Http\Parts\MessageBody;
use Chocala\System\ContentType;

class FakeMessageBody extends MessageBody
{

    public const DEFAULT_DATA = '';

    /**
     * @param mixed $bodyContent
     */
    public function __construct($bodyContent = self::DEFAULT_DATA)
    {
        parent::__construct(ContentType::TEXT_PLAIN, $bodyContent);
    }

}
