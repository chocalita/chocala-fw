<?php

namespace Chocala\Http\Request\Parts\Fakes;

use Chocala\Http\Request\Parts\MessageBody;
use Chocala\Http\Request\Parts\MessageBodyInterface;
use Chocala\System\ContentType;

class FakeMessageBody extends MessageBody implements MessageBodyInterface
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
