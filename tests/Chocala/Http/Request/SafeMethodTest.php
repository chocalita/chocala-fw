<?php

namespace Chocala\Http\Request;

use Chocala\Base\UnsupportedOperationException;
use Chocala\Http\HeadersInterface;
use Chocala\Http\Request\Parts\Fakes\FakeRequestData;
use Chocala\Http\Request\Parts\Fakes\FakeRequestDataNoBody;
use Chocala\Http\Request\Parts\Fakes\FakeRequestHeaders;
use Chocala\Http\Request\Parts\Fakes\FakeRequestLine;
use Chocala\Http\Request\Parts\RequestDataInterface;
use Chocala\Http\Request\Parts\RequestDataNoBody;
use Chocala\Http\Request\Parts\RequestHeadersInterface;
use Chocala\Http\Request\Parts\RequestLineInterface;
use Chocala\Http\RequestInterface;
use PHPUnit\Framework\TestCase;

// TODO: check if SafeMethod class is right
class SafeMethodTest extends TestCase
{
    /**
     * @var RequestInterface
     */
    private RequestInterface $baseRequest;

    /**
     * @var SafeMethod
     */
    private SafeMethod $defaultSafeMethod;

    public function testVar()
    {
        self::assertEquals('', '');
    }

    public function setUp()
    {
        $this->baseRequest = new Request(
            new Parts\Fakes\FakeRequestLine(),
            new Parts\Fakes\FakeRequestHeaders(),
            new FakeRequestDataNoBody()
        );
        $this->defaultSafeMethod = new SafeMethod($this->baseRequest);
    }

    public function test__construct()
    {
        $safeMethod = new SafeMethod($this->baseRequest);
        self::assertIsObject($safeMethod);
    }

    public function testUri()
    {
        self::assertInstanceOf(RequestLineInterface::class, $this->defaultSafeMethod->requestLine());
        self::assertEquals($this->baseRequest->requestLine(), $this->defaultSafeMethod->requestLine());
    }

    public function testHeaders()
    {
        self::assertInstanceOf(HeadersInterface::class, $this->defaultSafeMethod->headers());
        self::assertEquals($this->baseRequest->headers(), $this->defaultSafeMethod->headers());
    }

    public function testRequestData()
    {
        self::assertInstanceOf(RequestDataInterface::class, $this->defaultSafeMethod->requestData());
        self::assertInstanceOf(RequestDataNoBody::class, $this->defaultSafeMethod->requestData());
        self::assertEquals($this->baseRequest->requestData(), $this->defaultSafeMethod->requestData());
    }

    public function testNoBody()
    {
        $this->expectException(UnsupportedOperationException::class);
        $this->defaultSafeMethod->requestData()->body();
    }

    private function requestCustomObject(): RequestInterface
    {
        $request = new class () implements RequestInterface {
            public function requestLine(): RequestLineInterface
            {
                return new FakeRequestLine();
            }

            public function headers(): RequestHeadersInterface
            {
                return new FakeRequestHeaders();
            }

            public function requestData(): RequestDataInterface
            {
                return new FakeRequestData();
            }
        };
        return new $request();
    }
}
