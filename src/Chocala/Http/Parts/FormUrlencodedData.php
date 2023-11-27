<?php

namespace Chocala\Http\Parts;

use Chocala\Base\IllegalArgumentException;
use Chocala\System\ContentType;

class FormUrlencodedData implements MessageBodyInterface
{

    /**
     * @var MessageBody
     */
    private MessageBody $messageBody;

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
    public function body()
    {
        return $this->messageBody->body();
    }

}