<?php

namespace Chocala\Web;

use Chocala\Http\HttpMethod;
use Chocala\Web\Result\DefaultActionBody;
use Chocala\Web\Result\PrintActionBody;
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

    public function test_bodyAs()
    {
        $controllerBase = $this->newControllerBaseCustomClass();
        self::assertIsObject($controllerBase);
        try {
            self::assertAttributeInstanceOf(DefaultActionBody::class, '_actionBody', $controllerBase);
            $controllerBase->_bodyAs(new PrintActionBody());
            $controllerBase->set('name', 'john');
            $controllerBase->set('lastname', 'doe');
            self::assertAttributeInstanceOf(PrintActionBody::class, '_actionBody', $controllerBase);
        } catch (Exception $e) {
            self::fail();
        }
    }

    /**
     * @throws Exception
     */
    public function test_callback()
    {
        $controllerBase = $this->newControllerBaseCustomClass();
        self::assertIsObject($controllerBase);
        self::assertObjectHasAttribute('_data', $controllerBase);
        self::assertObjectHasAttribute('_actionBody', $controllerBase);
        $controllerBase->set('name', 'john');
        $controllerBase->set('lastname', 'doe');
        $res = $controllerBase->_callback('testData');
        $expected = json_encode(['name' => 'john', 'lastname' => 'doe']);
        self::assertNotNull($res);
        self::assertNotEmpty($res);
        self::assertIsObject($res);
        self::assertIsObject($res->body());
        self::assertEquals($expected, $res->body()->data());
    }

    /**
     * @throws Exception
     */
    public function test_duplicatedProcess()
    {
        $controllerBase = $this->newControllerBaseCustomClass();
        $res = $controllerBase->_callback('testData');
        $controllerBase->set('name', 'john');
        $this->expectException(DuplicatedRenderException::class);
        $this->expectExceptionMessageRegExp('/Operation render was did before./');
        $res2 = $controllerBase->_callback('testData');
    }

    private function newControllerBaseCustomClass()
    {
        $controllerBase = new class () extends ControllerBase implements ControllerInterface {
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

            // check why this method is not in the interface
            public function testData()
            {
                return $this->_data;
            }
        };

        return new $controllerBase();
    }
}
