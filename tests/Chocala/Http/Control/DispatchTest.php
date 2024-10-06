<?php

namespace Chocala\Http\Control;

use Chocala\Http\Fakes\FakeRequest;
use Chocala\Http\HttpMethod;
use Chocala\Http\Request\Parts\RequestLine;
use Chocala\Http\Response\Response;
use Chocala\Http\ResponseInterface;
use Chocala\Http\Route\Fakes\FakeActionMapping;
use Chocala\Http\ServerInterface;
use PHPUnit\Framework\TestCase;

class DispatchTest extends TestCase
{
    private Dispatch $dispatch;

    public function setUp()
    {
        //$this->dispatch = new Dispatch();
    }

    public function test__construct()
    {
        $dispatch = new Dispatch(
            new FakeRequest(),
            new FakeActionMapping()
        );
        self::assertNotNull($dispatch);
        self::assertIsObject($dispatch);
        self::assertInstanceOf(ServerInterface::class, $dispatch);
        self::assertInstanceOf(Dispatch::class, $dispatch);
    }

    public function testSubmit()
    {
        $dispatch = new Dispatch(
            new FakeRequest(),
            new FakeActionMapping()
        );
        $response = $dispatch->submit();

        self::assertNotNull($response);
        self::assertIsObject($response);
        self::assertInstanceOf(ResponseInterface::class, $response);
        self::assertInstanceOf(Response::class, $response);
        self::assertEquals(200, $response->status()->code());
        self::assertEmpty($response->headers()->headerList());
        self::assertNotEmpty($response->body()->data());

        self::assertNotNull($response);
    }

    public function testSubmitActions()
    {
        $dispatch = new Dispatch(
            new FakeRequest(new RequestLine(HttpMethod::GET(), '/section/test/dummy406')),
            new FakeActionMapping()
        );
        $response = $dispatch->submit();

        self::assertNotNull($response);
        self::assertIsObject($response);
        self::assertInstanceOf(ResponseInterface::class, $response);
        self::assertInstanceOf(Response::class, $response);
        self::assertEquals(406, $response->status()->code());
        self::assertEmpty($response->headers()->headerList());
        self::assertNotEmpty($response->body()->data());

        self::assertNotNull($response);
    }

    public function testHttpExceptionResponse()
    {
        $dispatch = new Dispatch(
            new FakeRequest(new RequestLine(HttpMethod::GET(), '/section/test/dummy500')),
            //new FakeRequest(new RequestLine(HttpMethod::GET(), 'http://localhost:8081/uriTo/controller/action')),
            new FakeActionMapping()
        );
        $response = $dispatch->submit();

        self::assertNotNull($response);
        self::assertIsObject($response);
        self::assertInstanceOf(ResponseInterface::class, $response);
        self::assertInstanceOf(Response::class, $response);
        self::assertEquals(500, $response->status()->code());
        self::assertEmpty($response->headers()->headerList());
        self::assertNotEmpty($response->body()->data());

        self::assertNotNull($response);
    }

}
