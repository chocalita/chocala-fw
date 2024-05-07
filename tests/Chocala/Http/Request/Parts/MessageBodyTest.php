<?php

namespace Chocala\Http\Request\Parts;

use Chocala\Base\IllegalArgumentException;
use Chocala\System\ContentType;
use PHPUnit\Framework\TestCase;

class MessageBodyTest extends TestCase
{
    public function test__construct()
    {
        $messageBody = new MessageBody(ContentType::TEXT_PLAIN, 'message');
        self::assertIsObject($messageBody);
        $this->expectException(IllegalArgumentException::class);
        new MessageBody(ContentType::TEXT_PLAIN, null);
    }

    public function testType()
    {
        foreach (ContentType::CONTENT_TYPE_LIST as $contentType) {
            $messageBody = new MessageBody($contentType, '');
            self::assertNotEmpty($messageBody->type());
            self::assertEquals($contentType, $messageBody->type());
        }
    }

    public function testData()
    {
        foreach (ContentType::CONTENT_TYPE_LIST as $body) {
            $messageBody = new MessageBody(ContentType::TEXT_PLAIN, $body);
            self::assertNotEmpty($messageBody->data());
            self::assertEquals($body, $messageBody->data());
        }

        $messageBody = new MessageBody(ContentType::TEXT_PLAIN, []);
        self::assertNotNull($messageBody->data());
        self::assertIsArray($messageBody->data());
        self::assertEmpty($messageBody->data());

        $messageBody = new MessageBody(ContentType::TEXT_PLAIN, 9999);
        self::assertNotNull($messageBody->data());
        self::assertIsNumeric($messageBody->data());
        self::assertEquals(9999, $messageBody->data());

        $arrayBase = [1, 2, 3];
        $messageBody = new MessageBody(ContentType::TEXT_PLAIN, new \ArrayIterator($arrayBase));
        self::assertNotNull($messageBody->data());
        self::assertIsObject($messageBody->data());
        self::assertSameSize($arrayBase, $messageBody->data());
        self::assertEquals(1, $messageBody->data()->offsetGet(0));
        self::assertEquals(2, $messageBody->data()->offsetGet(1));
        self::assertEquals(3, $messageBody->data()->offsetGet(2));
    }
}
