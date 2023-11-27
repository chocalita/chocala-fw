<?php

namespace Chocala\Http\Parts;

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
     */
    public function __construct($body)
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
    public function body()
    {
        return $this->messageBody->body();
    }

}