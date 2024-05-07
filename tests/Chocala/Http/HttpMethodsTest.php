<?php

namespace Http;

use Chocala\Http\HttpMethodEnum;
use Chocala\Http\HttpMethods;
use PHPUnit\Framework\TestCase;

class HttpMethodsTest extends TestCase
{
    private array $methods = [
        'GET',
        'POST',
        'PUT',
        'PATCH',
        'DELETE',
        'OPTIONS',
        'HEAD',
        'CONNECT',
        'TRACE'
    ];

    public function test__construct()
    {
        $object = new HttpMethods();
        self::assertNotNull($object);
        self::assertIsObject($object);
        self::assertInstanceOf(HttpMethods::class, $object);
    }

    public function testMake()
    {
        $object = new HttpMethods();

        foreach ($this->methods as $method) {
            $httpMethod = $object->make($method);
            self::assertNotNull($httpMethod);
            self::assertIsObject($httpMethod);
            self::assertInstanceOf(HttpMethodEnum::class, $httpMethod);
            self::assertEquals($method, $httpMethod->name());
        }
    }

    public function testUndefined()
    {
        $object = new HttpMethods();
        $this->expectException(\Exception::class);
        $object->make('REQ');
    }
}
