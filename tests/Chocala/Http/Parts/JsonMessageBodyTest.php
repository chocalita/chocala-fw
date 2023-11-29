<?php

namespace Chocala\Http\Parts;

use Chocala\Base\IllegalArgumentException;
use Chocala\System\ContentType;
use PHPUnit\Framework\TestCase;

class JsonMessageBodyTest extends TestCase
{

    public function test__construct()
    {
        $jsonMessageBody = new JsonMessageContent(null);
        self::assertIsObject($jsonMessageBody);
        $jsonMessageBody = new JsonMessageContent('');
        self::assertIsObject($jsonMessageBody);
        $jsonMessageBody = new JsonMessageContent('{}');
        self::assertIsObject($jsonMessageBody);
        $jsonMessageBody = new JsonMessageContent('[]');
        self::assertIsObject($jsonMessageBody);
        $jsonMessageBody = new JsonMessageContent('[{}]');
        self::assertIsObject($jsonMessageBody);
        $this->expectException(IllegalArgumentException::class);
        new JsonMessageContent('TjKnH7kj3');
    }

    public function testType()
    {
        $jsonMessageBody = new JsonMessageContent(null);
        self::assertIsObject($jsonMessageBody);
        self::assertEquals(ContentType::APPLICATION_JSON, $jsonMessageBody->type());
        $jsonMessageBody = new JsonMessageContent('');
        self::assertIsObject($jsonMessageBody);
        self::assertEquals(ContentType::APPLICATION_JSON, $jsonMessageBody->type());
        $jsonMessageBody = new JsonMessageContent('{}');
        self::assertIsObject($jsonMessageBody);
        self::assertEquals(ContentType::APPLICATION_JSON, $jsonMessageBody->type());
        $jsonMessageBody = new JsonMessageContent('[]');
        self::assertIsObject($jsonMessageBody);
        self::assertEquals(ContentType::APPLICATION_JSON, $jsonMessageBody->type());
    }

    public function testData()
    {
        $body = ' ';
        $jsonMessageContent = new JsonMessageContent($body);
        self::assertNotNull($jsonMessageContent->data());
        self::assertEmpty($jsonMessageContent->data());
        self::assertIsString($jsonMessageContent->data());
        self::assertEquals('', $jsonMessageContent->data());

        $body = '{ }';
        $jsonMessageContent = new JsonMessageContent($body);
        self::assertNotNull($jsonMessageContent->data());
        self::assertIsObject($jsonMessageContent->data());
        self::assertObjectNotHasAttribute('*', $jsonMessageContent->data());

        $body = '[ ]';
        $jsonMessageContent = new JsonMessageContent($body);
        self::assertNotNull($jsonMessageContent->data());
        self::assertIsArray($jsonMessageContent->data());
        self::assertEmpty($jsonMessageContent->data());

        $body = '{
            "key": "value"
        }';
        $jsonMessageContent = new JsonMessageContent($body);
        self::assertNotEmpty($jsonMessageContent->data());
        self::assertIsObject($jsonMessageContent->data());
        self::assertObjectHasAttribute('key', $jsonMessageContent->data());
        self::assertNotEmpty($jsonMessageContent->data()->key);
        self::assertEquals('value', $jsonMessageContent->data()->key);

        $body = '[1,2,3,4,5,6,7,8,9]';
        $jsonMessageContent = new JsonMessageContent($body);
        self::assertNotEmpty($jsonMessageContent->data());
        self::assertIsArray($jsonMessageContent->data());
        self::assertNotEmpty($jsonMessageContent->data());
        self::assertCount(9, $jsonMessageContent->data());
        self::assertContains(1, $jsonMessageContent->data());

        $body = '{
            "key": [1,2,3,4,5]
        }';
        $jsonMessageContent = new JsonMessageContent($body);
        self::assertNotEmpty($jsonMessageContent->data());
        self::assertIsObject($jsonMessageContent->data());
        self::assertNotNull($jsonMessageContent->data()->key);
        self::assertIsArray($jsonMessageContent->data()->key);
        self::assertCount(5, $jsonMessageContent->data()->key);

        $body = '{
            "int": 12,
            "float": 1.2,
            "string": "word",
            "array": [1,2,3,4,5],
            "object": {
                "oString": "oWord",
                "oArray": ["x","y","z"]
            }
        }';
        $jsonMessageContent = new JsonMessageContent($body);
        self::assertNotEmpty($jsonMessageContent->data());
        self::assertIsObject($jsonMessageContent->data());

        self::assertNotNull($jsonMessageContent->data()->int);
        self::assertIsInt($jsonMessageContent->data()->int);
        self::assertEquals(12, $jsonMessageContent->data()->int);

        self::assertNotNull($jsonMessageContent->data()->float);
        self::assertIsFloat($jsonMessageContent->data()->float);
        self::assertEquals(1.2, $jsonMessageContent->data()->float);

        self::assertNotNull($jsonMessageContent->data()->string);
        self::assertIsString($jsonMessageContent->data()->string);
        self::assertEquals('word', $jsonMessageContent->data()->string);

        self::assertNotNull($jsonMessageContent->data()->array);
        self::assertIsArray($jsonMessageContent->data()->array);
        self::assertCount(5, $jsonMessageContent->data()->array);

        self::assertNotNull($jsonMessageContent->data()->object);
        self::assertIsObject($jsonMessageContent->data()->object);
        self::assertObjectHasAttribute('oString', $jsonMessageContent->data()->object);
        self::assertObjectHasAttribute('oArray', $jsonMessageContent->data()->object);
        self::assertIsString($jsonMessageContent->data()->object->oString);
        self::assertIsArray($jsonMessageContent->data()->object->oArray);
        self::assertEquals('oWord', $jsonMessageContent->data()->object->oString);
        self::assertCount(3, $jsonMessageContent->data()->object->oArray);
        self::assertEquals("x", $jsonMessageContent->data()->object->oArray[0]);

        $body = '[
            12,
            1.2,
            "word",
            [1,2,3],
            {
                "oString": "oWord",
                "oArray": ["x","y","z"]
            }
        ]';
        $jsonMessageContent = new JsonMessageContent($body);
        self::assertNotEmpty($jsonMessageContent->data());
        self::assertIsArray($jsonMessageContent->data());
        self::assertNotNull($jsonMessageContent->data()[0]);
        self::assertNotNull($jsonMessageContent->data()[1]);
        self::assertNotNull($jsonMessageContent->data()[2]);
        self::assertNotNull($jsonMessageContent->data()[3]);
        self::assertNotNull($jsonMessageContent->data()[4]);

        self::assertIsInt($jsonMessageContent->data()[0]);
        self::assertIsFloat($jsonMessageContent->data()[1]);
        self::assertIsString($jsonMessageContent->data()[2]);
        self::assertIsArray($jsonMessageContent->data()[3]);
        self::assertIsObject($jsonMessageContent->data()[4]);

        self::assertEquals(12, $jsonMessageContent->data()[0]);
        self::assertEquals(1.2, $jsonMessageContent->data()[1]);
        self::assertEquals('word', $jsonMessageContent->data()[2]);
        self::assertCount(3, $jsonMessageContent->data()[3]);

        self::assertObjectHasAttribute('oString', $jsonMessageContent->data()[4]);
        self::assertObjectHasAttribute('oArray', $jsonMessageContent->data()[4]);
        self::assertIsString($jsonMessageContent->data()[4]->oString);
        self::assertIsArray($jsonMessageContent->data()[4]->oArray);

        self::assertEquals('oWord', $jsonMessageContent->data()[4]->oString);
        self::assertCount(3, $jsonMessageContent->data()[4]->oArray);
        self::assertEquals('x', $jsonMessageContent->data()[4]->oArray[0]);
        self::assertEquals('y', $jsonMessageContent->data()[4]->oArray[1]);
        self::assertEquals('z', $jsonMessageContent->data()[4]->oArray[2]);
    }

    public function testNumericBody()
    {
        $this->expectException(IllegalArgumentException::class);
        new JsonMessageContent('123');
    }

    public function testInvalidBody()
    {
        $this->expectException(IllegalArgumentException::class);
        new JsonMessageContent(' - ');
    }

}
