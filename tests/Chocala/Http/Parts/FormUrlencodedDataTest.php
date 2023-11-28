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
        self::assertNotNull($formUrlencodedData->data());
        self::assertEmpty($formUrlencodedData->data());
        self::assertIsArray($formUrlencodedData->data());
        self::assertCount(0, $formUrlencodedData->data());

        $body = ' key1=value1 & empty';
        $formUrlencodedData = new FormUrlencodedData($body);
        self::assertNotNull($formUrlencodedData->data());
        self::assertNotEmpty($formUrlencodedData->data());
        self::assertIsArray($formUrlencodedData->data());
        self::assertCount(2, $formUrlencodedData->data());
        self::assertEquals('value1 ', $formUrlencodedData->data()['key1']);
        self::assertEquals('', $formUrlencodedData->data()['empty']);

        $body = 'key1=value1&key2=value2 & ';
        $formUrlencodedData = new FormUrlencodedData($body);
        self::assertNotNull($formUrlencodedData->data());
        self::assertNotEmpty($formUrlencodedData->data());
        self::assertIsArray($formUrlencodedData->data());
        self::assertCount(2, $formUrlencodedData->data());
        self::assertEquals('value1', $formUrlencodedData->data()['key1']);
        self::assertEquals('value2 ', $formUrlencodedData->data()['key2']);

        $body = 'age=2020&testResult=9.9& ';
        $formUrlencodedData = new FormUrlencodedData($body);
        self::assertNotNull($formUrlencodedData->data());
        self::assertNotEmpty($formUrlencodedData->data());
        self::assertIsArray($formUrlencodedData->data());
        self::assertCount(2, $formUrlencodedData->data());
        self::assertEquals(2020, $formUrlencodedData->data()['age']);
        self::assertEquals('2020', $formUrlencodedData->data()['age']);
        self::assertEquals(9.9, $formUrlencodedData->data()['testResult']);
        self::assertEquals('9.9', $formUrlencodedData->data()['testResult']);

        $body = 'testK=testV&oneKey=OneValue&%2Aparsed%28key%29%24=%5B1%2C2%2C3%5D';
        $formUrlencodedData = new FormUrlencodedData($body);
        self::assertNotNull($formUrlencodedData->data());
        self::assertNotEmpty($formUrlencodedData->data());
        self::assertIsArray($formUrlencodedData->data());
        self::assertCount(3, $formUrlencodedData->data());
        self::assertEquals('testV', $formUrlencodedData->data()['testK']);
        self::assertEquals('OneValue', $formUrlencodedData->data()['oneKey']);
        self::assertEquals('[1,2,3]', $formUrlencodedData->data()['*parsed(key)$']);
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
