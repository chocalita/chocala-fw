<?php

namespace Chocala\Http\Parts;

use Chocala\Base\IllegalArgumentException;
use Chocala\System\ContentType;
use PHPUnit\Framework\TestCase;

class FormUrlencodedDataTest extends TestCase
{

    public function test__construct()
    {
        $jsonMessageBody = new FormUrlencodedData(null);
        self::assertIsObject($jsonMessageBody);
        $jsonMessageBody = new FormUrlencodedData('');
        self::assertIsObject($jsonMessageBody);
        $jsonMessageBody = new FormUrlencodedData('k=v');
        self::assertIsObject($jsonMessageBody);
        $jsonMessageBody = new FormUrlencodedData('key1=value1&key2=value2 & ');
        self::assertIsObject($jsonMessageBody);
        $jsonMessageBody = new FormUrlencodedData('testK=testV&oneKey=OneValue&%2Aparsed%28key%29%24=%5B1%2C2%2C3%5D');
        self::assertIsObject($jsonMessageBody);
        $this->expectException(IllegalArgumentException::class);
        new FormUrlencodedData('simpleWord');
    }

    public function testType()
    {
        $formUrlencodedData = new FormUrlencodedData(null);
        self::assertIsObject($formUrlencodedData);
        self::assertEquals(ContentType::APPLICATION_FORM_URLENCODED, $formUrlencodedData->type());
        $formUrlencodedData = new FormUrlencodedData(' ');
        self::assertIsObject($formUrlencodedData);
        self::assertEquals(ContentType::APPLICATION_FORM_URLENCODED, $formUrlencodedData->type());
        $formUrlencodedData = new FormUrlencodedData('key1=value1&key2=value2 & ');
        self::assertIsObject($formUrlencodedData);
        self::assertEquals(ContentType::APPLICATION_FORM_URLENCODED, $formUrlencodedData->type());
    }

    public function testBody()
    {
        $body = ' ';
        $formUrlencodedData = new FormUrlencodedData($body);
        self::assertNotNull($formUrlencodedData->body());
        self::assertEmpty($formUrlencodedData->body());
        self::assertIsArray($formUrlencodedData->body());
        self::assertCount(0, $formUrlencodedData->body());

        $body = ' key1=value1 & empty';
        $formUrlencodedData = new FormUrlencodedData($body);
        self::assertNotNull($formUrlencodedData->body());
        self::assertNotEmpty($formUrlencodedData->body());
        self::assertIsArray($formUrlencodedData->body());
        self::assertCount(2, $formUrlencodedData->body());
        self::assertEquals('value1 ', $formUrlencodedData->body()['key1']);
        self::assertEquals('', $formUrlencodedData->body()['empty']);

        $body = 'key1=value1&key2=value2 & ';
        $formUrlencodedData = new FormUrlencodedData($body);
        self::assertNotNull($formUrlencodedData->body());
        self::assertNotEmpty($formUrlencodedData->body());
        self::assertIsArray($formUrlencodedData->body());
        self::assertCount(2, $formUrlencodedData->body());
        self::assertEquals('value1', $formUrlencodedData->body()['key1']);
        self::assertEquals('value2 ', $formUrlencodedData->body()['key2']);

        $body = 'age=2020&testResult=9.9& ';
        $formUrlencodedData = new FormUrlencodedData($body);
        self::assertNotNull($formUrlencodedData->body());
        self::assertNotEmpty($formUrlencodedData->body());
        self::assertIsArray($formUrlencodedData->body());
        self::assertCount(2, $formUrlencodedData->body());
        self::assertEquals(2020, $formUrlencodedData->body()['age']);
        self::assertEquals('2020', $formUrlencodedData->body()['age']);
        self::assertEquals(9.9, $formUrlencodedData->body()['testResult']);
        self::assertEquals('9.9', $formUrlencodedData->body()['testResult']);

        $body = 'testK=testV&oneKey=OneValue&%2Aparsed%28key%29%24=%5B1%2C2%2C3%5D';
        $formUrlencodedData = new FormUrlencodedData($body);
        self::assertNotNull($formUrlencodedData->body());
        self::assertNotEmpty($formUrlencodedData->body());
        self::assertIsArray($formUrlencodedData->body());
        self::assertCount(3, $formUrlencodedData->body());
        self::assertEquals('testV', $formUrlencodedData->body()['testK']);
        self::assertEquals('OneValue', $formUrlencodedData->body()['oneKey']);
        self::assertEquals('[1,2,3]', $formUrlencodedData->body()['*parsed(key)$']);
    }

    public function testNumericBody()
    {
        $this->expectException(IllegalArgumentException::class);
        new FormUrlencodedData(123);
    }

    public function testInvalidBody()
    {
        $this->expectException(IllegalArgumentException::class);
        new FormUrlencodedData(' - ');
    }


}
