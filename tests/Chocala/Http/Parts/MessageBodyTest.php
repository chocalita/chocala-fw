<?php

namespace Chocala\Http\Parts;

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

    public function testBody()
    {
        foreach (ContentType::CONTENT_TYPE_LIST as $body) {
            $messageBody = new MessageBody(ContentType::TEXT_PLAIN, $body);
            self::assertNotEmpty($messageBody->body());
            self::assertEquals($body, $messageBody->body());
        }

        $messageBody = new MessageBody(ContentType::TEXT_PLAIN, []);
        self::assertNotNull($messageBody->body());
        self::assertIsArray($messageBody->body());
        self::assertEmpty($messageBody->body());

        $messageBody = new MessageBody(ContentType::TEXT_PLAIN, 9999);
        self::assertNotNull($messageBody->body());
        self::assertIsNumeric($messageBody->body());
        self::assertEquals(9999, $messageBody->body());

        $arrayBase = [1, 2, 3];
        $messageBody = new MessageBody(ContentType::TEXT_PLAIN, new \ArrayIterator($arrayBase));
        self::assertNotNull($messageBody->body());
        self::assertIsObject($messageBody->body());
        self::assertSameSize($arrayBase, $messageBody->body());
        self::assertEquals(1, $messageBody->body()->offsetGet(0));
        self::assertEquals(2, $messageBody->body()->offsetGet(1));
        self::assertEquals(3, $messageBody->body()->offsetGet(2));
    }

}
