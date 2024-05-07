<?php

namespace Chocala\Http\Response\Exceptions;

use Chocala\Http\Response\Parts\StatusCode;
use Chocala\Http\Response\Parts\StatusCodeEnum;
use PHPUnit\Framework\TestCase;

class HttpUnprocessableContentExceptionTest extends TestCase
{
    private StatusCodeEnum $defaultStatusCode;

    public function setUp()
    {
        $this->defaultStatusCode = StatusCode::UNPROCESSABLE_CONTENT();
    }

    public function test__construct()
    {
        $e = new HttpUnprocessableContentException();
        $this->assertBasics($e);

        $e = new HttpUnprocessableContentException('My message');
        $this->assertBasics($e);

        $e = new HttpUnprocessableContentException('My message', new \Exception('Test exception'));
        $this->assertBasics($e);
    }

    public function testStatusCode()
    {
        $e = new HttpUnprocessableContentException();
        $this->assertBasics($e);
        $this->assertBasicsStatusCode($e);
        self::assertEquals($this->defaultStatusCode, $e->statusCode());
    }

    public function testStatusCodeProperties()
    {
        $e = new HttpUnprocessableContentException();
        $this->assertBasics($e);
        $this->assertBasicsStatusCode($e);
        self::assertEquals($this->defaultStatusCode->code(), $e->statusCode()->code());
        self::assertEquals($this->defaultStatusCode->message(), $e->statusCode()->message());

        $myMessage = 'My unprocessable content message';
        $e = new HttpUnprocessableContentException($myMessage);
        $this->assertBasics($e);
        $this->assertBasicsStatusCode($e);
        self::assertEquals($this->defaultStatusCode->code(), $e->statusCode()->code());
        self::assertNotEquals($this->defaultStatusCode->message(), $e->statusCode()->message());
        self::assertEquals($myMessage, $e->statusCode()->message());
    }

    private function assertBasics($e)
    {
        self::assertNotNull($e);
        self::assertIsObject($e);
        self::assertInstanceOf(HttpResponseExceptionInterface::class, $e);
        self::assertInstanceOf(HttpResponseException::class, $e);
        self::assertInstanceOf(HttpUnprocessableContentException::class, $e);
    }

    private function assertBasicsStatusCode($e)
    {
        self::assertNotNull($e->statusCode());
        self::assertIsObject($e->statusCode());
        self::assertInstanceOf(StatusCodeEnum::class, $e->statusCode());
    }
}
