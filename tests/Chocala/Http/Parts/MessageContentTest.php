<?php

namespace Chocala\Http\Parts;

use Chocala\Base\IllegalArgumentException;
use Chocala\System\ContentType;
use PHPUnit\Framework\TestCase;

class MessageContentTest extends TestCase
{

    public function test__construct()
    {
        $messageContent = new MessageContent(ContentType::TEXT_PLAIN, 'message');
        self::assertIsObject($messageContent);
        $this->expectException(IllegalArgumentException::class);
        new MessageContent(ContentType::TEXT_PLAIN, null);
    }

    public function testType()
    {
        foreach (ContentType::CONTENT_TYPE_LIST as $contentType) {
            $messageContent = new MessageContent($contentType, '');
            self::assertNotEmpty($messageContent->type());
            self::assertEquals($contentType, $messageContent->type());
        }
    }

    public function testBody()
    {
        foreach (ContentType::CONTENT_TYPE_LIST as $body) {
            $messageContent = new MessageContent(ContentType::TEXT_PLAIN, $body);
            self::assertNotEmpty($messageContent->data());
            self::assertEquals($body, $messageContent->data());
        }

        $messageContent = new MessageContent(ContentType::TEXT_PLAIN, []);
        self::assertNotNull($messageContent->data());
        self::assertIsArray($messageContent->data());
        self::assertEmpty($messageContent->data());

        $messageContent = new MessageContent(ContentType::TEXT_PLAIN, 9999);
        self::assertNotNull($messageContent->data());
        self::assertIsNumeric($messageContent->data());
        self::assertEquals(9999, $messageContent->data());

        $arrayBase = [1, 2, 3];
        $messageContent = new MessageContent(ContentType::TEXT_PLAIN, new \ArrayIterator($arrayBase));
        self::assertNotNull($messageContent->data());
        self::assertIsObject($messageContent->data());
        self::assertSameSize($arrayBase, $messageContent->data());
        self::assertEquals(1, $messageContent->data()->offsetGet(0));
        self::assertEquals(2, $messageContent->data()->offsetGet(1));
        self::assertEquals(3, $messageContent->data()->offsetGet(2));
    }

}
