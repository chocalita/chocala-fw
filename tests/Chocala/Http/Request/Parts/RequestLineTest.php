<?php

namespace Chocala\Http\Request\Parts;

use Chocala\Http\HttpMethod;
use PHPUnit\Framework\TestCase;
use TypeError;

class RequestLineTest extends TestCase
{
    /**
     * @var RequestLine
     */
    private RequestLine $requestLine;

    protected function setUp()
    {
        $this->requestLine = new RequestLine(
            HttpMethod::PUT(),
            'http://localhost/api/vx/custom/uri',
            'HTTP/1.1'
        );
    }

    public function test__construct()
    {
        $requestLine = new RequestLine(HttpMethod::GET(), 'http://localhost/api/va', 'HTTP/1.1');
        self::assertIsObject($requestLine);

        $requestLine = new RequestLine(HttpMethod::GET(), 'http://localhost/api/va');
        self::assertIsObject($requestLine);

        $this->expectException(TypeError::class);
        $this->expectExceptionMessageRegExp('/Argument 1 passed to/');
        new RequestLine('NO GET', 'http://localhost/api/vb', 'HTTP/1.0');
    }

    public function testMethod()
    {
        self::assertNotNull($this->requestLine->method());
        self::assertEquals(HttpMethod::PUT(), $this->requestLine->method());
    }

    public function testRequestUri()
    {
        self::assertNotNull($this->requestLine->requestUri());
        self::assertEquals('http://localhost/api/vx/custom/uri', $this->requestLine->requestUri());
    }

    public function testHttpVersion()
    {
        self::assertNotNull($this->requestLine->httpVersion());
        self::assertEquals('HTTP/1.1', $this->requestLine->httpVersion());
    }
}
