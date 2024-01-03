<?php

namespace Chocala\Web;

use Chocala\Http\HttpMethod;
use Chocala\Http\Response\Parts\StatusCode;
use Chocala\Web\Result\DefaultActionResult;
use Chocala\Web\Result\PrintActionResult;
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

    public function test_isAllowedMethod()
    {
        $controllerBase = $this->newControllerBaseCustomClass();
        self::assertIsObject($controllerBase);
        self::assertTrue($controllerBase->_isAllowedMethod('index', HttpMethod::GET()));
        self::assertTrue($controllerBase->_isAllowedMethod('index', HttpMethod::POST()));
        self::assertTrue($controllerBase->_isAllowedMethod('get', HttpMethod::GET()));
        self::assertFalse($controllerBase->_isAllowedMethod('get', HttpMethod::POST()));
        self::assertTrue($controllerBase->_isAllowedMethod('post', HttpMethod::POST()));
        self::assertFalse($controllerBase->_isAllowedMethod('post', HttpMethod::GET()));
        self::assertTrue($controllerBase->_isAllowedMethod('put', HttpMethod::PUT()));
        self::assertTrue($controllerBase->_isAllowedMethod('patch', HttpMethod::PATCH()));
        self::assertTrue($controllerBase->_isAllowedMethod('delete', HttpMethod::DELETE()));
    }

    public function test_apply()
    {
        $controllerBase = $this->newControllerBaseCustomClass();
        self::assertIsObject($controllerBase);
        try {
            self::assertAttributeInstanceOf(DefaultActionResult::class, '_actionResult', $controllerBase);
            $controllerBase->_apply(new PrintActionResult(StatusCode::OK()));
            self::assertTrue(true);
            $controllerBase->set('name', 'john');
            $controllerBase->set('lastname', 'doe');
            self::assertAttributeInstanceOf(PrintActionResult::class, '_actionResult', $controllerBase);
        } catch (Exception $e) {
            self::fail();
        }
    }

    public function test_render()
    {
        $controllerBase = $this->newControllerBaseCustomClass();
        self::assertIsObject($controllerBase);
        self::assertObjectHasAttribute('_data', $controllerBase);
        self::assertObjectHasAttribute('_actionResult', $controllerBase);
        $controllerBase->set('name', 'john');
        $controllerBase->set('lastname', 'doe');
        $res = $controllerBase->_render();
        $expected = json_encode(['name' => 'john', 'lastname' => 'doe']);
        self::assertNotNull($res);
        self::assertNotEmpty($res);
        self::assertIsNotObject($res);
        self::assertEquals($expected, $res);
    }

    public function test_duplicatedRender()
    {
        $controllerBase = $this->newControllerBaseCustomClass();
        $res = $controllerBase->_render();
        $controllerBase->set('name', 'john');
        $this->expectException(DuplicatedRenderException::class);
        $this->expectExceptionMessageRegExp('/Operation render was did before./');
        $res2 = $controllerBase->_render();
    }

    private function newControllerBaseCustomClass()
    {
        $controllerBase = new class() extends ControllerBase implements ControllerInterface {

            protected array $_allowedMethods = [
                'index' => '*',
                'get' => 'GET',
                'post' => 'POST',
                'put' => 'PUT',
                'patch' => 'PATCH',
                'delete' => 'DELETE'
            ];

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