<?php

namespace Chocala\Http;

use PHPUnit\Framework\TestCase;

class HttpMethodTest extends TestCase
{

    public function testName()
    {
        $httpMethod = $this->httpMethodCustomClass();
        self::assertIsObject($httpMethod);
        self::assertEquals('CUSTOM', $httpMethod->name());
    }

    public function testId()
    {
        $httpMethod = $this->httpMethodCustomClass();
        self::assertNotNull($httpMethod->id());
        self::assertGreaterThan(8, strlen($httpMethod->id()));
    }

    public function testData()
    {
        $httpMethod = $this->httpMethodCustomClass();
        $size = sizeof($this->arrayValue());
        self::assertNotEmpty($httpMethod->data());
        self::assertCount($size, $httpMethod->data());
        $_REQUEST['123'] = 123;
        self::assertCount($size + 1, $httpMethod->data());
        self::assertEquals(123, $httpMethod->get('123'));
        unset($_REQUEST['lastKey']);
        self::assertCount($size, $httpMethod->data());
    }

    public function testHas()
    {
        $httpMethod = $this->httpMethodCustomClass();
        self::assertIsBool($httpMethod->has('var0'));
        self::assertIsBool($httpMethod->has('INVALID_KEY'));
        self::assertTrue($httpMethod->has('var0'));
        self::assertFalse($httpMethod->has('INVALID_KEY'));
    }

    public function testGet()
    {
        $httpMethod = $this->httpMethodCustomClass();
        self::assertNull($httpMethod->get('INVALID_KEY'));
        self::assertEquals('zero', $httpMethod->get('var0'));
        self::assertIsNumeric($httpMethod->get('numericKey'));
        self::assertIsArray($httpMethod->get('arrayKey'));
        self::assertNull($httpMethod->get('nullKey'));
        self::assertEquals('DEFAULT_VALUE', $httpMethod->get('DEFAULT_01234XYZ', 'DEFAULT_VALUE'));
    }

    public function testDelete()
    {
        $httpMethod = $this->httpMethodCustomClass();
        $size = sizeof($this->arrayValue());
        self::assertCount($size, $httpMethod->data());
        $httpMethod->delete('removedKey');
        self::assertCount($size - 1, $httpMethod->data());
        self::assertEquals($httpMethod, $httpMethod->delete('INVALID_KEY'));
        self::assertCount($size - 1, $httpMethod->data());
    }

    public function testExtract()
    {
        $httpMethod = $this->httpMethodCustomClass();
        $size = sizeof($this->arrayValue());
        self::assertCount($size, $httpMethod->data());
        self::assertEquals('extractedValue', $httpMethod->extract('extractedKey'));
        self::assertCount($size - 1, $httpMethod->data());
        self::assertNull($httpMethod->extract('INVALID_KEY'));
        self::assertCount($size - 1, $httpMethod->data());
    }

    public function testBody()
    {
        $httpMethod = $this->httpMethodCustomClass();
        //TODO: create tests
        print_r($httpMethod->body());
        self::assertNull(null);
    }

    private function httpMethodCustomClass(): HttpMethod
    {
        $httpMethod = new class() extends HttpMethod {

            public function __construct()
            {
                $this->name = 'CUSTOM';
                $this->data = &$_REQUEST;
                $this->id = $this->generateId();
            }

        };
        $_REQUEST = $this->arrayValue();
        return new $httpMethod();
    }

    public function arrayValue(): array
    {
        return [
            'var0' => 'zero',
            'numericKey' => 789,
            'arrayKey' => [],
            'nullKey' => null,
            'removedKey' => 'removedValue',
            'extractedKey' => 'extractedValue',
            'lastKey' => 'last'
        ];
    }

}
