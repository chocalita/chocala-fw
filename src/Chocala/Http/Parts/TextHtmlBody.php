<?php

namespace Chocala\Http\Parts;

use Chocala\Base\IllegalArgumentException;
use Chocala\System\ContentType;

class TextHtmlBody implements MessageBodyInterface
{

    const HTML_TAG_PATTERN = "#(?<=<)\w+(?=[^<]*?>)#";

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
        $body = is_null($body) ? '' : (is_string($body) ? trim($body) : $body);
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
    public function body()
    {
        return $this->messageBody->body();
    }

}
