<?php

namespace Chocala\Web;

use Exception;
use PHPUnit\Framework\TestCase;

class ControllerBaseTest extends TestCase
{

    public function test__construct()
    {
        $controllerBase = $this->newControllerBaseCustomClass();
        self::assertIsObject($controllerBase);
    }

    public function testSet()
    {
        $controllerBase = $this->newControllerBaseCustomClass();
        self::assertIsObject($controllerBase);
        self::assertObjectHasAttribute('_data', $controllerBase);
        self::assertIsObject($controllerBase->testData());
        self::assertCount(0, $controllerBase->testData()->vars());
        $controllerBase->set('foo', 1);
        self::assertCount(1, $controllerBase->testData()->vars());
    }

    public function test_init()
    {
        $controllerBase = $this->newControllerBaseCustomClass();
        try {
            $controllerBase->_init();
            self::assertTrue(true);
        } catch (Exception $e) {
            self::fail();
        }
    }

//    public function test_isAllowedMethod(string $action, HttpMethodEnum $method){
//        $controllerBase = $this->newControllerBaseCustomClass();
//    }

//    public function test_apply(ActionResultInterface $actionResult){
//        $controllerBase = $this->newControllerBaseCustomClass();
//    }

//    public function test_render(){
//        $controllerBase = $this->newControllerBaseCustomClass();
//    }

    private function newControllerBaseCustomClass()
    {
        $controllerBase = new class() extends ControllerBase implements ControllerInterface {

            public function __construct()
            {
                parent::__construct();
            }

            public function testData()
            {
                return $this->_data;
            }

        };
        return new $controllerBase();
    }

}