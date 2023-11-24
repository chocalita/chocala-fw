<?php

namespace Chocala\Http\Parts;

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

    public function testBody()
    {
        $body = ' ';
        $jsonMessageBody = new JsonMessageBody($body);
        self::assertNotNull($jsonMessageBody->body());
        self::assertEmpty($jsonMessageBody->body());
        self::assertIsString($jsonMessageBody->body());
        self::assertEquals('', $jsonMessageBody->body());

        $body = '{ }';
        $jsonMessageBody = new JsonMessageBody($body);
        self::assertNotNull($jsonMessageBody->body());
        self::assertIsObject($jsonMessageBody->body());
        self::assertObjectNotHasAttribute('*', $jsonMessageBody->body());

        $body = '[ ]';
        $jsonMessageBody = new JsonMessageBody($body);
        self::assertNotNull($jsonMessageBody->body());
        self::assertIsArray($jsonMessageBody->body());
        self::assertEmpty($jsonMessageBody->body());

        $body = '{
            "key": "value"
        }';
        $jsonMessageBody = new JsonMessageBody($body);
        self::assertNotEmpty($jsonMessageBody->body());
        self::assertIsObject($jsonMessageBody->body());
        self::assertObjectHasAttribute('key', $jsonMessageBody->body());
        self::assertNotEmpty($jsonMessageBody->body()->key);
        self::assertEquals('value', $jsonMessageBody->body()->key);

        $body = '[1,2,3,4,5,6,7,8,9]';
        $jsonMessageBody = new JsonMessageBody($body);
        self::assertNotEmpty($jsonMessageBody->body());
        self::assertIsArray($jsonMessageBody->body());
        self::assertNotEmpty($jsonMessageBody->body());
        self::assertCount(9, $jsonMessageBody->body());
        self::assertContains(1, $jsonMessageBody->body());

        $body = '{
            "key": [1,2,3,4,5]
        }';
        $jsonMessageBody = new JsonMessageBody($body);
        self::assertNotEmpty($jsonMessageBody->body());
        self::assertIsObject($jsonMessageBody->body());
        self::assertNotNull($jsonMessageBody->body()->key);
        self::assertIsArray($jsonMessageBody->body()->key);
        self::assertCount(5, $jsonMessageBody->body()->key);

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
        self::assertNotEmpty($jsonMessageBody->body());
        self::assertIsObject($jsonMessageBody->body());

        self::assertNotNull($jsonMessageBody->body()->int);
        self::assertIsInt($jsonMessageBody->body()->int);
        self::assertEquals(12, $jsonMessageBody->body()->int);

        self::assertNotNull($jsonMessageBody->body()->float);
        self::assertIsFloat($jsonMessageBody->body()->float);
        self::assertEquals(1.2, $jsonMessageBody->body()->float);

        self::assertNotNull($jsonMessageBody->body()->string);
        self::assertIsString($jsonMessageBody->body()->string);
        self::assertEquals('word', $jsonMessageBody->body()->string);

        self::assertNotNull($jsonMessageBody->body()->array);
        self::assertIsArray($jsonMessageBody->body()->array);
        self::assertCount(5, $jsonMessageBody->body()->array);

        self::assertNotNull($jsonMessageBody->body()->object);
        self::assertIsObject($jsonMessageBody->body()->object);
        self::assertObjectHasAttribute('oString', $jsonMessageBody->body()->object);
        self::assertObjectHasAttribute('oArray', $jsonMessageBody->body()->object);
        self::assertIsString($jsonMessageBody->body()->object->oString);
        self::assertIsArray($jsonMessageBody->body()->object->oArray);
        self::assertEquals('oWord', $jsonMessageBody->body()->object->oString);
        self::assertCount(3, $jsonMessageBody->body()->object->oArray);
        self::assertEquals("x", $jsonMessageBody->body()->object->oArray[0]);

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
        self::assertNotEmpty($jsonMessageBody->body());
        self::assertIsArray($jsonMessageBody->body());
        self::assertNotNull($jsonMessageBody->body()[0]);
        self::assertNotNull($jsonMessageBody->body()[1]);
        self::assertNotNull($jsonMessageBody->body()[2]);
        self::assertNotNull($jsonMessageBody->body()[3]);
        self::assertNotNull($jsonMessageBody->body()[4]);

        self::assertIsInt($jsonMessageBody->body()[0]);
        self::assertIsFloat($jsonMessageBody->body()[1]);
        self::assertIsString($jsonMessageBody->body()[2]);
        self::assertIsArray($jsonMessageBody->body()[3]);
        self::assertIsObject($jsonMessageBody->body()[4]);

        self::assertEquals(12, $jsonMessageBody->body()[0]);
        self::assertEquals(1.2, $jsonMessageBody->body()[1]);
        self::assertEquals('word', $jsonMessageBody->body()[2]);
        self::assertCount(3, $jsonMessageBody->body()[3]);

        self::assertObjectHasAttribute('oString', $jsonMessageBody->body()[4]);
        self::assertObjectHasAttribute('oArray', $jsonMessageBody->body()[4]);
        self::assertIsString($jsonMessageBody->body()[4]->oString);
        self::assertIsArray($jsonMessageBody->body()[4]->oArray);

        self::assertEquals('oWord', $jsonMessageBody->body()[4]->oString);
        self::assertCount(3, $jsonMessageBody->body()[4]->oArray);
        self::assertEquals('x', $jsonMessageBody->body()[4]->oArray[0]);
        self::assertEquals('y', $jsonMessageBody->body()[4]->oArray[1]);
        self::assertEquals('z', $jsonMessageBody->body()[4]->oArray[2]);
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
