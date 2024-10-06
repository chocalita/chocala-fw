<?php

namespace Chocala\Http\Control;

use Chocala\Http\Control\Fakes\FakeDispatch;
use Chocala\Http\HttpManagement;
use PHPUnit\Framework\TestCase;

class FrontControllerTest extends TestCase
{

    public function setUp()
    {
    }

    public function test__construct()
    {
        $frontController = new FrontController(new FakeDispatch());
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
        $dispatch = new FakeDispatch();
        $frontController = new FrontController($dispatch);
        $this->expectNotToPerformAssertions();
        // TODO: expect result in buffer
        $frontController->route();
    }
}
