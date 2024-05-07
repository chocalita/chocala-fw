<?php

namespace Chocala\Http\Request\Parts;

use Chocala\Base\IllegalArgumentException;
use Chocala\System\ContentType;
use PHPUnit\Framework\TestCase;

class JsonMessageBodyTest extends TestCase
{
    public function test__construct()
    {
        $jsonMessageBody = new JsonMessageBody(null);
        self::assertIsObject($jsonMessageBody);
        $jsonMessageBody = new JsonMessageBody('');
        self::assertIsObject($jsonMessageBody);
        $jsonMessageBody = new JsonMessageBody('{}');
        self::assertIsObject($jsonMessageBody);
        $jsonMessageBody = new JsonMessageBody('[]');
        self::assertIsObject($jsonMessageBody);
        $jsonMessageBody = new JsonMessageBody('[{}]');
        self::assertIsObject($jsonMessageBody);
        $this->expectException(IllegalArgumentException::class);
        new JsonMessageBody('TjKnH7kj3');
    }

    public function testType()
    {
        $jsonMessageBody = new JsonMessageBody(null);
        self::assertIsObject($jsonMessageBody);
        self::assertEquals(ContentType::APPLICATION_JSON, $jsonMessageBody->type());
        $jsonMessageBody = new JsonMessageBody('');
        self::assertIsObject($jsonMessageBody);
        self::assertEquals(ContentType::APPLICATION_JSON, $jsonMessageBody->type());
        $jsonMessageBody = new JsonMessageBody('{}');
        self::assertIsObject($jsonMessageBody);
        self::assertEquals(ContentType::APPLICATION_JSON, $jsonMessageBody->type());
        $jsonMessageBody = new JsonMessageBody('[]');
        self::assertIsObject($jsonMessageBody);
        self::assertEquals(ContentType::APPLICATION_JSON, $jsonMessageBody->type());
    }

    public function testData()
    {
        $body = ' ';
        $jsonMessageBody = new JsonMessageBody($body);
        self::assertNotNull($jsonMessageBody->data());
        self::assertEmpty($jsonMessageBody->data());
        self::assertIsString($jsonMessageBody->data());
        self::assertEquals('', $jsonMessageBody->data());

        $body = '{ }';
        $jsonMessageBody = new JsonMessageBody($body);
        self::assertNotNull($jsonMessageBody->data());
        self::assertIsObject($jsonMessageBody->data());
        self::assertObjectNotHasAttribute('*', $jsonMessageBody->data());

        $body = '[ ]';
        $jsonMessageBody = new JsonMessageBody($body);
        self::assertNotNull($jsonMessageBody->data());
        self::assertIsArray($jsonMessageBody->data());
        self::assertEmpty($jsonMessageBody->data());

        $body = '{
            "key": "value"
        }';
        $jsonMessageBody = new JsonMessageBody($body);
        self::assertNotEmpty($jsonMessageBody->data());
        self::assertIsObject($jsonMessageBody->data());
        self::assertObjectHasAttribute('key', $jsonMessageBody->data());
        self::assertNotEmpty($jsonMessageBody->data()->key);
        self::assertEquals('value', $jsonMessageBody->data()->key);

        $body = '[1,2,3,4,5,6,7,8,9]';
        $jsonMessageBody = new JsonMessageBody($body);
        self::assertNotEmpty($jsonMessageBody->data());
        self::assertIsArray($jsonMessageBody->data());
        self::assertNotEmpty($jsonMessageBody->data());
        self::assertCount(9, $jsonMessageBody->data());
        self::assertContains(1, $jsonMessageBody->data());

        $body = '{
            "key": [1,2,3,4,5]
        }';
        $jsonMessageBody = new JsonMessageBody($body);
        self::assertNotEmpty($jsonMessageBody->data());
        self::assertIsObject($jsonMessageBody->data());
        self::assertNotNull($jsonMessageBody->data()->key);
        self::assertIsArray($jsonMessageBody->data()->key);
        self::assertCount(5, $jsonMessageBody->data()->key);

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
        $jsonMessageBody = new JsonMessageBody($body);
        self::assertNotEmpty($jsonMessageBody->data());
        self::assertIsObject($jsonMessageBody->data());

        self::assertNotNull($jsonMessageBody->data()->int);
        self::assertIsInt($jsonMessageBody->data()->int);
        self::assertEquals(12, $jsonMessageBody->data()->int);

        self::assertNotNull($jsonMessageBody->data()->float);
        self::assertIsFloat($jsonMessageBody->data()->float);
        self::assertEquals(1.2, $jsonMessageBody->data()->float);

        self::assertNotNull($jsonMessageBody->data()->string);
        self::assertIsString($jsonMessageBody->data()->string);
        self::assertEquals('word', $jsonMessageBody->data()->string);

        self::assertNotNull($jsonMessageBody->data()->array);
        self::assertIsArray($jsonMessageBody->data()->array);
        self::assertCount(5, $jsonMessageBody->data()->array);

        self::assertNotNull($jsonMessageBody->data()->object);
        self::assertIsObject($jsonMessageBody->data()->object);
        self::assertObjectHasAttribute('oString', $jsonMessageBody->data()->object);
        self::assertObjectHasAttribute('oArray', $jsonMessageBody->data()->object);
        self::assertIsString($jsonMessageBody->data()->object->oString);
        self::assertIsArray($jsonMessageBody->data()->object->oArray);
        self::assertEquals('oWord', $jsonMessageBody->data()->object->oString);
        self::assertCount(3, $jsonMessageBody->data()->object->oArray);
        self::assertEquals('x', $jsonMessageBody->data()->object->oArray[0]);

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
        $jsonMessageBody = new JsonMessageBody($body);
        self::assertNotEmpty($jsonMessageBody->data());
        self::assertIsArray($jsonMessageBody->data());
        self::assertNotNull($jsonMessageBody->data()[0]);
        self::assertNotNull($jsonMessageBody->data()[1]);
        self::assertNotNull($jsonMessageBody->data()[2]);
        self::assertNotNull($jsonMessageBody->data()[3]);
        self::assertNotNull($jsonMessageBody->data()[4]);

        self::assertIsInt($jsonMessageBody->data()[0]);
        self::assertIsFloat($jsonMessageBody->data()[1]);
        self::assertIsString($jsonMessageBody->data()[2]);
        self::assertIsArray($jsonMessageBody->data()[3]);
        self::assertIsObject($jsonMessageBody->data()[4]);

        self::assertEquals(12, $jsonMessageBody->data()[0]);
        self::assertEquals(1.2, $jsonMessageBody->data()[1]);
        self::assertEquals('word', $jsonMessageBody->data()[2]);
        self::assertCount(3, $jsonMessageBody->data()[3]);

        self::assertObjectHasAttribute('oString', $jsonMessageBody->data()[4]);
        self::assertObjectHasAttribute('oArray', $jsonMessageBody->data()[4]);
        self::assertIsString($jsonMessageBody->data()[4]->oString);
        self::assertIsArray($jsonMessageBody->data()[4]->oArray);

        self::assertEquals('oWord', $jsonMessageBody->data()[4]->oString);
        self::assertCount(3, $jsonMessageBody->data()[4]->oArray);
        self::assertEquals('x', $jsonMessageBody->data()[4]->oArray[0]);
        self::assertEquals('y', $jsonMessageBody->data()[4]->oArray[1]);
        self::assertEquals('z', $jsonMessageBody->data()[4]->oArray[2]);
    }

    public function testNumericBody()
    {
        $this->expectException(IllegalArgumentException::class);
        new JsonMessageBody('123');
    }

    public function testInvalidBody()
    {
        $this->expectException(IllegalArgumentException::class);
        new JsonMessageBody(' - ');
    }
}
