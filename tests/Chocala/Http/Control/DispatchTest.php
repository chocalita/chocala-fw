<?php

namespace Chocala\Http\Control;

use Chocala\Http\Fakes\FakeRequest;
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
        $object = new Dispatch(
            //new FakeRequest(new RequestLine(HttpMethod::GET(), '/uriTo/controller/action')),
            //new FakeRequest(new RequestLine(HttpMethod::GET(), 'http://localhost:8081/uriTo/controller/action')),
            new FakeRequest(),
            new FakeActionMapping()
        );
        self::assertNotNull($object);
        self::assertIsObject($object);
        self::assertInstanceOf(ServerInterface::class, $object);
        self::assertInstanceOf(Dispatch::class, $object);
    }

    public function testSubmit()
    {
        // TODO: test $dispatch->submit() method
        self::assertNotNull(1);
        $object = new Dispatch(
            new FakeRequest(),
            new FakeActionMapping()
        );
        $vx = new \App\Controllers\section\VxController();
        $response = $object->submit();

        //self::assertNotNull($response);

        $x = 'y';
    }
}
