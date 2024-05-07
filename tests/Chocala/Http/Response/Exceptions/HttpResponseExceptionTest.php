<?php

namespace Chocala\Http\Response\Exceptions;

use Chocala\Http\Response\Parts\StatusCode;
use Chocala\Http\Response\Parts\StatusCodeEnum;
use PHPUnit\Framework\TestCase;

class HttpResponseExceptionTest extends TestCase
{
    public function test__construct()
    {
        $e = new HttpResponseException(new StatusCode(1, 'Message'));
        $this->assertsBase($e);

        $e = new HttpResponseException(new StatusCode(1, 'Message'), new \Exception('Test exception'));
        $this->assertsBase($e);

        $this->expectException(\ArgumentCountError::class);
        $e = new HttpResponseException();
    }

    public function testStatusCode()
    {
        $e = new HttpResponseException(new StatusCode(1, 'Message'));
        self::assertIsObject($e);
        self::assertNotNull($e->statusCode());
        self::assertIsObject($e->statusCode());
        self::assertInstanceOf(StatusCodeEnum::class, $e->statusCode());
    }


    private function assertsBase($e)
    {
        self::assertNotNull($e);
        self::assertIsObject($e);
        self::assertInstanceOf(HttpResponseExceptionInterface::class, $e);
        self::assertInstanceOf(HttpResponseException::class, $e);
    }
}
