<?php

namespace Chocala\Http\Parts;

use Chocala\Base\IllegalArgumentException;
use Chocala\System\ContentType;

class JsonMessageContent implements MessageContentInterface
{

    /**
     * @var MessageContent
     */
    private MessageContent $messageContent;

    /**
     * JsonMessageBody constructor.
     * @param $body mixed
     */
    public function __construct(?string $body)
    {
        $decodedBody = trim($body) === '' ? '' : json_decode($body, false);
        if ($decodedBody === null || is_numeric($decodedBody)) {
            throw new IllegalArgumentException('Invalid json body');
        }
        $this->messageContent = new MessageContent(ContentType::APPLICATION_JSON, $decodedBody);
    }

    /**
     * @return string
     */
    public function type(): string
    {
        return $this->messageContent->type();
    }

    /**
     * @return mixed
     */
    public function data()
    {
        return $this->messageContent->data();
    }

}