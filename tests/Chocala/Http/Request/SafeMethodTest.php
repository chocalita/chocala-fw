<?php

namespace Chocala\Http\Request;

use Chocala\Base\UnsupportedOperationException;
use Chocala\Http\Fakes\FakeRequestLine;
use Chocala\Http\Fakes\FakeHeaders;
use Chocala\Http\Fakes\FakeMessageBody;
use Chocala\Http\Fakes\FakeRequest;
use Chocala\Http\Parts\HeadersInterface;
use Chocala\Http\Parts\RequestLineInterface;
use PHPUnit\Framework\TestCase;

class SafeMethodTest extends TestCase
{

    /**
     * @var FakeRequest
     */
    private $baseFakeRequest;

    /**
     * @var SafeMethod
     */
    private $defaultSafeMethod;

    public function setUp()
    {
        $this->baseFakeRequest = new FakeRequest();
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

    public function testMessageBody()
    {
        $this->expectException(UnsupportedOperationException::class);
        $this->defaultSafeMethod->messageBody();
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
