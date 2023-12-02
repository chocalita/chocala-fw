<?php

namespace Chocala\Http\Request;

use Chocala\Base\UnsupportedOperationException;
use Chocala\Http\Fakes\FakeHeaders;
use Chocala\Http\Fakes\FakeMessageBody;
use Chocala\Http\Fakes\FakeRequest;
use Chocala\Http\Fakes\FakeRequestLine;
use Chocala\Http\Request\Parts\Fakes\FakeRequestDataNoBody;
use Chocala\Http\Request\Parts\HeadersInterface;
use Chocala\Http\Request\Parts\RequestDataInterface;
use Chocala\Http\Request\Parts\RequestDataNoBody;
use Chocala\Http\Request\Parts\RequestLineInterface;
use PHPUnit\Framework\TestCase;

class SafeMethodTest extends TestCase
{

    /**
     * @var FakeRequest
     */
    private FakeRequest $baseFakeRequest;

    /**
     * @var SafeMethod
     */
    private SafeMethod $defaultSafeMethod;

    public function testVar()
    {
        self::assertEquals('', "");
    }

    public function setUp()
    {
        $this->baseFakeRequest = new FakeRequest(
            new Parts\Fakes\FakeRequestLine(),
            new Parts\Fakes\FakeHeaders(),
            new FakeRequestDataNoBody()
        );
        $this->defaultSafeMethod = new SafeMethod($this->baseFakeRequest);
    }

    public function test__construct()
    {
        $safeMethod = new SafeMethod($this->baseFakeRequest);
        self::assertIsObject($safeMethod);
    }

    public function testUri()
    {
        self::assertInstanceOf(RequestLineInterface::class, $this->defaultSafeMethod->requestLine());
        self::assertEquals($this->baseFakeRequest->requestLine(), $this->defaultSafeMethod->requestLine());
    }

    public function testHeaders()
    {
        self::assertInstanceOf(HeadersInterface::class, $this->defaultSafeMethod->headers());
        self::assertEquals($this->baseFakeRequest->headers(), $this->defaultSafeMethod->headers());
    }

    public function testRequestData()
    {
        self::assertInstanceOf(RequestDataInterface::class, $this->defaultSafeMethod->requestData());
        self::assertInstanceOf(RequestDataNoBody::class, $this->defaultSafeMethod->requestData());
        self::assertEquals($this->baseFakeRequest->requestData(), $this->defaultSafeMethod->requestData());
    }

    public function testNoBody()
    {
        $this->expectException(UnsupportedOperationException::class);
        $this->defaultSafeMethod->requestData()->body();
    }

    private function requestCustomObject(): RequestInterface
    {
        $request = new class() implements RequestInterface {

            public function requestLine(): RequestLineInterface
            {
                return new FakeRequestLine();
            }

            public function headers(): HeadersInterface
            {
                return new FakeHeaders();
            }

            public function messageBody(): MessageBodyInterface
            {
                return new FakeMessageBody();
            }
        };
        return new $request();
    }

}
