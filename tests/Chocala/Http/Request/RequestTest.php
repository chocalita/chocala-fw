<?php

namespace Chocala\Http\Request;

use Chocala\Http\Request\Parts\Fakes\FakeRequestData;
use Chocala\Http\Request\Parts\Fakes\FakeRequestHeaders;
use Chocala\Http\Request\Parts\Fakes\FakeRequestLine;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    /**
     * @var FakeRequestLine
     */
    private FakeRequestLine $fakeRequestLine;

    /**
     * @var FakeRequestHeaders
     */
    private FakeRequestHeaders $fakeHeaders;

    /**
     * @var FakeRequestData
     */
    private FakeRequestData $fakeRequestData;

    /**
     * @var Request
     */
    private Request $commonRequest;

    public function setUp()
    {
        $this->fakeRequestLine = new FakeRequestLine();
        $this->fakeHeaders = new FakeRequestHeaders();
        $this->fakeRequestData = new FakeRequestData();
        $this->commonRequest = new Request($this->fakeRequestLine, $this->fakeHeaders, $this->fakeRequestData);
    }

    public function test__construct()
    {
        $request = new Request($this->fakeRequestLine, $this->fakeHeaders, $this->fakeRequestData);
        self::assertNotNull($request);
        self::assertIsObject($request);
        $this->expectException(\TypeError::class);
        new Request(null, null, null);
    }

    public function testObject()
    {
        $request = $this->commonRequest;
        self::assertNotNull($request);
        self::assertIsObject($request);
        self::assertInstanceOf(Request::class, $request);
        self::assertObjectHasAttribute('requestLine', $request);
        self::assertObjectHasAttribute('headers', $request);
        self::assertObjectHasAttribute('requestData', $request);
    }

    public function testRequestLine()
    {
        $request = $this->commonRequest;
        self::assertIsObject($request);
        self::assertObjectHasAttribute('requestLine', $request);
        self::assertIsObject($request->requestLine());
    }

    public function testHeaders()
    {
        $request = $this->commonRequest;
        self::assertIsObject($request);
        self::assertObjectHasAttribute('headers', $request);
        self::assertIsObject($request->headers());
    }

    public function testRequestData()
    {
        $request = $this->commonRequest;
        self::assertIsObject($request);
        self::assertObjectHasAttribute('requestData', $request);
        self::assertIsObject($request->requestData());
    }
}
