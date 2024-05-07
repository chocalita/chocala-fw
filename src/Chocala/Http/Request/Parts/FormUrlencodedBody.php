<?php

namespace Chocala\Http\Request\Parts;

use Chocala\Base\IllegalArgumentException;
use Chocala\System\ContentType;

class FormUrlencodedBody implements MessageBodyInterface
{
    /**
     * @var MessageBody
     */
    private MessageBody $messageBody;

    /**
     * FormUrlencodedData constructor.
     * @param string|null $body
     * @throws IllegalArgumentException
     */
    public function __construct(?string $body)
    {
        $body = is_null($body) ? '' : $body;
        if (!is_string($body) || (trim($body) !== '' && strpos($body, '=') === false)) {
            throw new IllegalArgumentException('Invalid x-www-form-urlencoded body');
        }
        $arrayBody = [];
        parse_str($body, $arrayBody);
        $this->messageBody = new MessageBody(ContentType::APPLICATION_FORM_URLENCODED, $arrayBody);
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
