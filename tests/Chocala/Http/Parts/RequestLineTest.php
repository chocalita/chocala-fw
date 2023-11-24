<?php

namespace Chocala\Http\Parts;

use Chocala\Base\IllegalArgumentException;
use PHPUnit\Framework\TestCase;

class RequestLineTest extends TestCase
{

    /**
     * @var RequestLine
     */
    private $requestLine;

    protected function setUp()
    {
        $this->requestLine = new RequestLine(
            'PUT',
            'http://localhost/api/vx/custom/uri',
            'HTTP/1.1'
        );
    }

    public function test__construct()
    {
        $requestLine = new RequestLine('GET', 'http://localhost/api/va', 'HTTP/1.1');
        self::assertIsObject($requestLine);
        $this->expectException(IllegalArgumentException::class);
        new RequestLine('NO GET', 'http://localhost/api/vb', 'HTTP/1.0');
    }

    public function testMethod()
    {
        self::assertNotNull($this->requestLine->method());
        self::assertEquals('PUT', $this->requestLine->method());
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
