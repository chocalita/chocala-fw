<?php

namespace Chocala\Http\Request\Parts;

use Chocala\Base\IllegalArgumentException;
use Chocala\System\ContentType;

class TextHtmlBody implements MessageBodyInterface
{
    const HTML_TAG_PATTERN = '#(?<=<)\w+(?=[^<]*?>)#';

    /**
     * @var MessageBody
     */
    private MessageBody $messageBody;

    /**
     * FormUrlencodedData constructor.
     * @param $body mixed
     * @throws IllegalArgumentException
     */
    public function __construct(?string $body)
    {
        $body = is_null($body) ? '' : trim($body);
        if (!empty($body) && !preg_match(self::HTML_TAG_PATTERN, $body)) {
            throw new IllegalArgumentException('Invalid text html body');
        }
        $this->messageBody = new MessageBody(ContentType::TEXT_HTML, $body);
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
