<?php

namespace Chocala\Http;

use PHPUnit\Framework\TestCase;

class HttpMethodTest extends TestCase
{
    public function testHttpEnum()
    {
        $httpEnumValue = HttpMethod::GET();
        $name = 'GET';
        self::basicAsserts($httpEnumValue);
        self::assertEquals($name, $httpEnumValue);
        self::assertNotSame($name, $httpEnumValue);
        self::assertTrue($httpEnumValue->isSafe());

        $httpEnumValue = HttpMethod::POST();
        $name = 'POST';
        self::basicAsserts($httpEnumValue);
        self::assertEquals($name, $httpEnumValue);
        self::assertNotSame($name, $httpEnumValue);
        self::assertFalse($httpEnumValue->isSafe());

        $httpEnumValue = HttpMethod::PUT();
        $name = 'PUT';
        self::basicAsserts($httpEnumValue);
        self::assertEquals($name, $httpEnumValue);
        self::assertNotSame($name, $httpEnumValue);
        self::assertFalse($httpEnumValue->isSafe());

        $httpEnumValue = HttpMethod::PATCH();
        $name = 'PATCH';
        self::basicAsserts($httpEnumValue);
        self::assertEquals($name, $httpEnumValue);
        self::assertNotSame($name, $httpEnumValue);
        self::assertFalse($httpEnumValue->isSafe());

        $httpEnumValue = HttpMethod::DELETE();
        $name = 'DELETE';
        self::basicAsserts($httpEnumValue);
        self::assertEquals($name, $httpEnumValue);
        self::assertNotSame($name, $httpEnumValue);
        self::assertTrue($httpEnumValue->isSafe());

        $httpEnumValue = HttpMethod::OPTIONS();
        $name = 'OPTIONS';
        self::basicAsserts($httpEnumValue);
        self::assertEquals($name, $httpEnumValue);
        self::assertNotSame($name, $httpEnumValue);
        self::assertTrue($httpEnumValue->isSafe());

        $httpEnumValue = HttpMethod::HEAD();
        $name = 'HEAD';
        self::basicAsserts($httpEnumValue);
        self::assertEquals($name, $httpEnumValue);
        self::assertNotSame($name, $httpEnumValue);
        self::assertTrue($httpEnumValue->isSafe());

        $httpEnumValue = HttpMethod::CONNECT();
        $name = 'CONNECT';
        self::basicAsserts($httpEnumValue);
        self::assertEquals($name, $httpEnumValue);
        self::assertNotSame($name, $httpEnumValue);
        self::assertFalse($httpEnumValue->isSafe());

        $httpEnumValue = HttpMethod::TRACE();
        $name = 'TRACE';
        self::basicAsserts($httpEnumValue);
        self::assertEquals($name, $httpEnumValue);
        self::assertNotSame($name, $httpEnumValue);
        self::assertTrue($httpEnumValue->isSafe());
    }

    private static function basicAsserts($httpEnumValue)
    {
        self::assertNotNull($httpEnumValue);
        self::assertIsObject($httpEnumValue);
        self::assertInstanceOf(HttpMethodEnum::class, $httpEnumValue);
        self::assertInstanceOf(HttpMethod::class, $httpEnumValue);
    }
}
