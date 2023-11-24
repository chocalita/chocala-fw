<?php

namespace Chocala\Http;

require_once 'HttpMethodTest.php';

class PutTest extends HttpMethodTest
{

    public function testName()
    {
        $put = $this->newObject();
        self::assertIsObject($put);
        self::assertEquals(HttpMethod::PUT, $put->name());
    }

/*

    public function testId()
    {
        $put = $this->newObject();
        self::assertNotNull($put->id());
        self::assertGreaterThan(8, strlen($put->id()));
    }

    public function testData()
    {
        $put = $this->newObject();
        $size = sizeof($this->arrayValue());
        self::assertNotEmpty($put->data());
        self::assertCount($size, $put->data());
        $_PUT['123'] = 123;
        self::assertCount($size + 1, $put->data());
        self::assertEquals(123, $put->get('123'));
        unset($_PUT['lastKey']);
        self::assertCount($size, $put->data());
    }

    public function testHas()
    {
        $put = $this->newObject();
        self::assertIsBool($put->has('var0'));
        self::assertIsBool($put->has('INVALID_KEY'));
        self::assertTrue($put->has('var0'));
        self::assertFalse($put->has('INVALID_KEY'));
    }

    public function testGet()
    {
        $put = $this->newObject();
        self::assertNull($put->get('INVALID_KEY'));
        self::assertEquals('zero', $put->get('var0'));
        self::assertIsNumeric($put->get('numericKey'));
        self::assertIsArray($put->get('arrayKey'));
        self::assertNull($put->get('nullKey'));
        self::assertEquals('DEFAULT_VALUE', $put->get('DEFAULT_01234XYZ', 'DEFAULT_VALUE'));
    }

    public function testDelete()
    {
        $put = $this->newObject();
        $size = sizeof($this->arrayValue());
        self::assertCount($size, $put->data());
        $put->delete('removedKey');
        self::assertCount($size - 1, $put->data());
        self::assertEquals($put, $put->delete('INVALID_KEY'));
        self::assertCount($size - 1, $put->data());
    }

    public function testExtract()
    {
        $put = $this->newObject();
        $size = sizeof($this->arrayValue());
        self::assertCount($size, $put->data());
        self::assertEquals('extractedValue', $put->extract('extractedKey'));
        self::assertCount($size - 1, $put->data());
        self::assertNull($put->extract('INVALID_KEY'));
        self::assertCount($size - 1, $put->data());
    }

    public function testBody()
    {
        $put = $this->newObject();
        //TODO: create tests
        self::assertEmpty($put->body());
    }
*/
    private function newObject()
    {
        $_PUT = $this->arrayValue();
        return new Put();
    }

}