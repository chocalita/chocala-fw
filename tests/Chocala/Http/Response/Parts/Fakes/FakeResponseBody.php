<?php

namespace Chocala\Http\Response\Parts\Fakes;

use Chocala\Http\Response\Parts\ResponseBody;
use Chocala\Http\Response\Parts\ResponseBodyInterface;
use Chocala\System\ContentType;

class FakeResponseBody extends ResponseBody implements ResponseBodyInterface
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
