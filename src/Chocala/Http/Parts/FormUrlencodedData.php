<?php

namespace Chocala\Http\Parts;

use Chocala\Base\IllegalArgumentException;
use Chocala\System\ContentType;

class FormUrlencodedData implements MessageContentInterface
{

    /**
     * @var MessageContent
     */
    private MessageContent $messageBody;

    /**
     * FormUrlencodedData constructor.
     * @param $body mixed
     */
    public function __construct($body)
    {
        $body = is_null($body) ? '' : $body;
        if (!is_string($body) || (trim($body) !== '' && strpos($body, '=') === false)) {
            throw new IllegalArgumentException('Invalid x-www-form-urlencoded body');
        }
        $arrayBody = [];
        parse_str($body, $arrayBody);
        $this->messageBody = new MessageContent(ContentType::APPLICATION_FORM_URLENCODED, $arrayBody);
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