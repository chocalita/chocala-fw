<?php

namespace Chocala\Http\Parts;

use Chocala\Base\IllegalArgumentException;
use Chocala\System\ContentType;

class TextHtmlContent implements MessageContentInterface
{

    const HTML_TAG_PATTERN = "#(?<=<)\w+(?=[^<]*?>)#";

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
        $body = is_null($body) ? '' : (is_string($body) ? trim($body) : $body);
        if (!empty($body) && !preg_match(self::HTML_TAG_PATTERN, $body)) {
            throw new IllegalArgumentException('Invalid text html body');
        }
        $this->messageBody = new MessageContent(ContentType::TEXT_HTML, $body);
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
