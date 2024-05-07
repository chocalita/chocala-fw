<?php

namespace Chocala\Http\Request\Parts;

use Chocala\Base\IllegalArgumentException;
use Chocala\System\ContentType;

class JsonMessageBody implements MessageBodyInterface
{
    /**
     * @var MessageBody
     */
    private MessageBody $messageBody;

    /**
     * JsonMessageBody constructor.
     * @param $body mixed
     * @throws IllegalArgumentException
     */
    public function __construct(?string $body)
    {
        $decodedBody = trim($body) === '' ? '' : json_decode($body, false);
        if ($decodedBody === null || is_numeric($decodedBody)) {
            throw new IllegalArgumentException('Invalid json body');
        }
        $this->messageBody = new MessageBody(ContentType::APPLICATION_JSON, $decodedBody);
    }

    /**
     * @return string
     */
    public function type(): string
    {
        return $this->messageBody->type();
    }

    /**
     * @return mixed
     */
    public function data()
    {
        return $this->messageBody->data();
    }
}
