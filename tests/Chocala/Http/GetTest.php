<?php

namespace Chocala\Http;

require_once 'HttpMethodTest.php';

class GetTest extends HttpMethodTest
{

    public function testName()
    {
        $get = $this->newObject();
        self::assertIsObject($get);
        self::assertEquals(HttpMethod::GET, $get->name());
    }

    public function testId()
    {
        $get = $this->newObject();
        self::assertNotNull($get->id());
        self::assertGreaterThan(8, strlen($get->id()));
    }

    public function testData()
    {
        $get = $this->newObject();
        $size = sizeof($this->arrayValue());
        self::assertNotEmpty($get->data());
        self::assertCount($size, $get->data());
        $_GET['123'] = 123;
        self::assertCount($size + 1, $get->data());
        self::assertEquals(123, $get->get('123'));
        unset($_GET['lastKey']);
        self::assertCount($size, $get->data());
    }

    public function testHas()
    {
        $get = $this->newObject();
        self::assertIsBool($get->has('var0'));
        self::assertIsBool($get->has('INVALID_KEY'));
        self::assertTrue($get->has('var0'));
        self::assertFalse($get->has('INVALID_KEY'));
    }

    public function testGet()
    {
        $get = $this->newObject();
        self::assertNull($get->get('INVALID_KEY'));
        self::assertEquals('zero', $get->get('var0'));
        self::assertIsNumeric($get->get('numericKey'));
        self::assertIsArray($get->get('arrayKey'));
        self::assertNull($get->get('nullKey'));
        self::assertEquals('DEFAULT_VALUE', $get->get('DEFAULT_01234XYZ', 'DEFAULT_VALUE'));
    }

    public function testDelete()
    {
        $get = $this->newObject();
        $size = sizeof($this->arrayValue());
        self::assertCount($size, $get->data());
        $get->delete('removedKey');
        self::assertCount($size - 1, $get->data());
        self::assertEquals($get, $get->delete('INVALID_KEY'));
        self::assertCount($size - 1, $get->data());
    }

    public function testExtract()
    {
        $get = $this->newObject();
        $size = sizeof($this->arrayValue());
        self::assertCount($size, $get->data());
        self::assertEquals('extractedValue', $get->extract('extractedKey'));
        self::assertCount($size - 1, $get->data());
        self::assertNull($get->extract('INVALID_KEY'));
        self::assertCount($size - 1, $get->data());
    }

    public function testBody()
    {
        $get = $this->newObject();
        $this->expectException(\Exception::class);
        $get->body();
    }

    private function newObject()
    {
        $_GET = $this->arrayValue();
        return new Get();
    }

}