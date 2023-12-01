<?php

namespace Chocala\Http\Request;

use Chocala\Http\Parts\Fakes\FakeHeaders;
use Chocala\Http\Parts\Fakes\FakeMessageBody;
use Chocala\Http\Parts\Fakes\FakeRequestLine;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{

    /**
     * @var FakeRequestLine
     */
    private FakeRequestLine $fakeRequestLine;

    /**
     * @var FakeHeaders
     */
    private FakeHeaders $fakeHeaders;

    /**
     * @var FakeMessageBody
     */
    private FakeMessageBody $fakeMessageBody;

    /**
     * @var Request
     */
    private Request $commonRequest;

    public function setUp()
    {
        $this->fakeRequestLine = new FakeRequestLine();
        $this->fakeHeaders = new FakeHeaders();
        $this->fakeMessageBody = new FakeMessageBody();
        $this->commonRequest = new Request($this->fakeRequestLine, $this->fakeHeaders, $this->fakeMessageBody);
    }

    public function test__construct()
    {
        $request = new Request($this->fakeRequestLine, $this->fakeHeaders, $this->fakeMessageBody);
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
        self::assertObjectHasAttribute('messageBody', $request);
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

    public function testMessageBody()
    {
        $request = $this->commonRequest;
        self::assertIsObject($request);
        self::assertObjectHasAttribute('messageBody', $request);
        self::assertIsObject($request->messageBody());
    }

}
