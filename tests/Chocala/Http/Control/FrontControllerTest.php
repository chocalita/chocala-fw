<?php

namespace Chocala\Http\Control;

use Chocala\Http\Control\Fakes\FakeDispatch;
use Chocala\Http\Fakes\FakeRequest;
use Chocala\Http\HttpManagement;
use Chocala\Http\HttpMethod;
use Chocala\Http\Request\Parts\RequestLine;
use Chocala\Http\Response\Exceptions\HttpNotImplementedException;
use Chocala\Http\Response\Exceptions\HttpResponseException;
use Chocala\Http\Response\Parts\StatusCode;
use Chocala\Http\ServerInterface;
use PHPUnit\Framework\TestCase;

class FrontControllerTest extends TestCase
{

    private ServerInterface $fakeDispatch;

    public function setUp()
    {
        $this->fakeDispatch = new FakeDispatch();
    }

    public function test__construct()
    {
        $frontController = new FrontController($this->fakeDispatch);
        self::assertNotNull($frontController);
        self::assertIsObject($frontController);
        self::assertInstanceOf(HttpManagement::class, $frontController);
        self::assertInstanceOf(FrontController::class, $frontController);
    }

    /**
     * @doesNotPerformAssertions
     * @return void
     */
    public function testRoute()
    {
        $frontController = new FrontController($this->fakeDispatch);
        // TODO: expect result in buffer
        $frontController->route();
    }

    public function testSimpleRoute()
    {
        $frontController = new FrontController($this->fakeDispatch);
        try {
            $frontController->route();
            $this->addToAssertionCount(1);
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }
    }
    public function testNotImplementedRoute()
    {
        $dispatch = new FakeDispatch(
            new FakeRequest(
                new RequestLine(HttpMethod::GET(), '/section/vx/notImplemented-resource')
            )
        );
        $frontController = new FrontController($dispatch);
        try {
            $frontController->route();
        } catch (HttpNotImplementedException $e) {
            self::assertInstanceOf(HttpResponseException::class, $e);
            self::assertEquals(StatusCode::NOT_IMPLEMENTED()->code(), $e->statusCode()->code());
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }
    }
}
