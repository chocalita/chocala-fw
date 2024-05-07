<?php

namespace Chocala\Http\Request\Parts;

use Chocala\Base\IllegalArgumentException;
use Chocala\System\ContentType;
use PHPUnit\Framework\TestCase;

class FormUrlencodedBodyTest extends TestCase
{
    public function test__construct()
    {
        $jsonMessageBody = new FormUrlencodedBody(null);
        self::assertIsObject($jsonMessageBody);

        $jsonMessageBody = new FormUrlencodedBody('');
        self::assertIsObject($jsonMessageBody);

        $jsonMessageBody = new FormUrlencodedBody('k=v');
        self::assertIsObject($jsonMessageBody);

        $jsonMessageBody = new FormUrlencodedBody('key1=value1&key2=value2 & ');
        self::assertIsObject($jsonMessageBody);

        $jsonMessageBody = new FormUrlencodedBody('testK=testV&oneKey=OneValue&%2Aparsed%28key%29%24=%5B1%2C2%2C3%5D');
        self::assertIsObject($jsonMessageBody);

        $this->expectException(IllegalArgumentException::class);
        new FormUrlencodedBody('simpleWord');
    }

    public function testType()
    {
        $formUrlencodedBody = new FormUrlencodedBody(null);
        self::assertIsObject($formUrlencodedBody);
        self::assertEquals(ContentType::APPLICATION_FORM_URLENCODED, $formUrlencodedBody->type());
        $formUrlencodedBody = new FormUrlencodedBody(' ');
        self::assertIsObject($formUrlencodedBody);
        self::assertEquals(ContentType::APPLICATION_FORM_URLENCODED, $formUrlencodedBody->type());
        $formUrlencodedBody = new FormUrlencodedBody('key1=value1&key2=value2 & ');
        self::assertIsObject($formUrlencodedBody);
        self::assertEquals(ContentType::APPLICATION_FORM_URLENCODED, $formUrlencodedBody->type());
    }

    public function testData()
    {
        $body = ' ';
        $formUrlencodedBody = new FormUrlencodedBody($body);
        self::assertNotNull($formUrlencodedBody->data());
        self::assertEmpty($formUrlencodedBody->data());
        self::assertIsArray($formUrlencodedBody->data());
        self::assertCount(0, $formUrlencodedBody->data());

        $body = ' key1=value1 & empty';
        $formUrlencodedBody = new FormUrlencodedBody($body);
        self::assertNotNull($formUrlencodedBody->data());
        self::assertNotEmpty($formUrlencodedBody->data());
        self::assertIsArray($formUrlencodedBody->data());
        self::assertCount(2, $formUrlencodedBody->data());
        self::assertEquals('value1 ', $formUrlencodedBody->data()['key1']);
        self::assertEquals('', $formUrlencodedBody->data()['empty']);

        $body = 'key1=value1&key2=value2 & ';
        $formUrlencodedBody = new FormUrlencodedBody($body);
        self::assertNotNull($formUrlencodedBody->data());
        self::assertNotEmpty($formUrlencodedBody->data());
        self::assertIsArray($formUrlencodedBody->data());
        self::assertCount(2, $formUrlencodedBody->data());
        self::assertEquals('value1', $formUrlencodedBody->data()['key1']);
        self::assertEquals('value2 ', $formUrlencodedBody->data()['key2']);

        $body = 'age=2020&testResult=9.9& ';
        $formUrlencodedBody = new FormUrlencodedBody($body);
        self::assertNotNull($formUrlencodedBody->data());
        self::assertNotEmpty($formUrlencodedBody->data());
        self::assertIsArray($formUrlencodedBody->data());
        self::assertCount(2, $formUrlencodedBody->data());
        self::assertEquals(2020, $formUrlencodedBody->data()['age']);
        self::assertEquals('2020', $formUrlencodedBody->data()['age']);
        self::assertEquals(9.9, $formUrlencodedBody->data()['testResult']);
        self::assertEquals('9.9', $formUrlencodedBody->data()['testResult']);

        $body = 'testK=testV&oneKey=OneValue&%2Aparsed%28key%29%24=%5B1%2C2%2C3%5D';
        $formUrlencodedBody = new FormUrlencodedBody($body);
        self::assertNotNull($formUrlencodedBody->data());
        self::assertNotEmpty($formUrlencodedBody->data());
        self::assertIsArray($formUrlencodedBody->data());
        self::assertCount(3, $formUrlencodedBody->data());
        self::assertEquals('testV', $formUrlencodedBody->data()['testK']);
        self::assertEquals('OneValue', $formUrlencodedBody->data()['oneKey']);
        self::assertEquals('[1,2,3]', $formUrlencodedBody->data()['*parsed(key)$']);
    }

    public function testNumericBody()
    {
        $this->expectException(IllegalArgumentException::class);
        new FormUrlencodedBody(123);
    }

    public function testInvalidBody()
    {
        $this->expectException(IllegalArgumentException::class);
        new FormUrlencodedBody(' - ');
    }
}
