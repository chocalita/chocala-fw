<?php

namespace Http\Mapping;

use Chocala\Http\Mapping\ActionMap;
use Chocala\Http\Mapping\ActionMapInterface;
use Chocala\Http\Mapping\Fakes\FakeActionMap;
use Chocala\Http\Mapping\LinkedActionMap;
use PHPUnit\Framework\TestCase;

class LinkedActionMapTest extends TestCase
{

    private array $mapValues = [
        '_module' => 'testModule',
        '_controller' => 'testController',
        '_action' => 'testAction',
        '_id' => 'testId',
        '_params' => 'testParams',
    ];

    protected function initRequest()
    {
        $_REQUEST = $this->mapValues;
    }

    public function test__construct()
    {
        $object = new LinkedActionMap($_REQUEST, new FakeActionMap());
        self::assertNotNull($object);
        self::assertIsObject($object);
        self::assertInstanceOf(ActionMapInterface::class, $object);
        self::assertInstanceOf(LinkedActionMap::class, $object);
        self::assertNotInstanceOf(ActionMap::class, $object);
    }

    public function testModule()
    {
        $this->initRequest();
        $arrayActionMap = new LinkedActionMap($_REQUEST, new FakeActionMap());
        self::assertIsObject($arrayActionMap);
        self::assertNotNull($arrayActionMap->module());
        self::assertNotEmpty($arrayActionMap->module());
        self::assertIsString($arrayActionMap->module());
        self::assertEquals($this->mapValues['_module'], $arrayActionMap->module());

        $_REQUEST['_module'] = 'value';
        self::assertEquals('value', $arrayActionMap->module());

        unset($_REQUEST['_module']);
        self::assertEquals(FakeActionMap::DEFAULT_MODULE, $arrayActionMap->module());
    }

    public function testController()
    {
        $this->initRequest();
        $arrayActionMap = new LinkedActionMap($_REQUEST, new FakeActionMap());
        self::assertIsObject($arrayActionMap);
        self::assertNotNull($arrayActionMap->controller());
        self::assertNotEmpty($arrayActionMap->controller());
        self::assertIsString($arrayActionMap->controller());
        self::assertEquals($this->mapValues['_controller'], $arrayActionMap->controller());

        $_REQUEST['_controller'] = 'value';
        self::assertEquals('value', $arrayActionMap->controller());

        unset($_REQUEST['_controller']);
        self::assertEquals(FakeActionMap::DEFAULT_CONTROLLER, $arrayActionMap->controller());
    }

    public function testAction()
    {
        $this->initRequest();
        $arrayActionMap = new LinkedActionMap($_REQUEST, new FakeActionMap());
        self::assertIsObject($arrayActionMap);
        self::assertNotNull($arrayActionMap->action());
        self::assertNotEmpty($arrayActionMap->action());
        self::assertIsString($arrayActionMap->action());
        self::assertEquals($this->mapValues['_action'], $arrayActionMap->action());

        $_REQUEST['_action'] = 'value';
        self::assertEquals('value', $arrayActionMap->action());

        unset($_REQUEST['_action']);
        self::assertEquals(FakeActionMap::DEFAULT_ACTION, $arrayActionMap->action());
    }

    public function testId()
    {
        $this->initRequest();
        $arrayActionMap = new LinkedActionMap($_REQUEST, new FakeActionMap());
        self::assertIsObject($arrayActionMap);
        self::assertNotNull($arrayActionMap->id());
        self::assertNotEmpty($arrayActionMap->id());
        self::assertIsString($arrayActionMap->id());
        self::assertEquals($this->mapValues['_id'], $arrayActionMap->id());

        $_REQUEST['_id'] = 'value';
        self::assertEquals('value', $arrayActionMap->id());

        unset($_REQUEST['_id']);
        self::assertEquals(FakeActionMap::DEFAULT_ID, $arrayActionMap->id());

        $_REQUEST['_id'] = '1';
        self::assertEquals('1', $arrayActionMap->id());
        $_REQUEST['_id'] = 10;
        self::assertEquals('10', $arrayActionMap->id());
        self::assertNotSame('10', $arrayActionMap->id());
        self::assertSame(10, $arrayActionMap->id());
    }


    public function testParams()
    {
        $this->initRequest();
        $arrayActionMap = new LinkedActionMap($_REQUEST, new FakeActionMap());
        self::assertIsObject($arrayActionMap);
        self::assertNotNull($arrayActionMap->params());
        self::assertNotEmpty($arrayActionMap->params());
        self::assertIsArray($arrayActionMap->params());
        self::assertNotEquals($this->mapValues['_params'], $arrayActionMap->params());
        self::assertEquals(FakeActionMap::DEFAULT_PARAMS, $arrayActionMap->params());

        unset($_REQUEST['_action']);
        self::assertEquals(FakeActionMap::DEFAULT_ACTION, $arrayActionMap->action());
    }

    public function testOverride()
    {
        $overValues = [
            '_module' => 'overModule',
            '_controller' => 'overController',
            '_action' => 'overAction',
            '_id' => 'overId',
            '_params' => [],
        ];
        $this->initRequest();
        $arrayActionMap = new LinkedActionMap($overValues, new LinkedActionMap($_REQUEST, new FakeActionMap()));
        self::assertIsObject($arrayActionMap);

        self::assertEquals($overValues['_module'], $arrayActionMap->module());
        unset($overValues['_module']);
        self::assertEquals($this->mapValues['_module'], $arrayActionMap->module());
        unset($_REQUEST['_module']);
        self::assertEquals(FakeActionMap::DEFAULT_MODULE, $arrayActionMap->module());

        self::assertEquals($overValues['_controller'], $arrayActionMap->controller());
        unset($overValues['_controller']);
        self::assertEquals($this->mapValues['_controller'], $arrayActionMap->controller());
        unset($_REQUEST['_controller']);
        self::assertEquals(FakeActionMap::DEFAULT_CONTROLLER, $arrayActionMap->controller());

        self::assertEquals($overValues['_action'], $arrayActionMap->action());
        unset($overValues['_action']);
        self::assertEquals($this->mapValues['_action'], $arrayActionMap->action());
        unset($_REQUEST['_action']);
        self::assertEquals(FakeActionMap::DEFAULT_ACTION, $arrayActionMap->action());

        self::assertEquals($overValues['_id'], $arrayActionMap->id());
        unset($overValues['_id']);
        self::assertEquals($this->mapValues['_id'], $arrayActionMap->id());
        unset($_REQUEST['_id']);
        self::assertEquals(FakeActionMap::DEFAULT_ID, $arrayActionMap->id());

        self::assertNotEmpty($arrayActionMap->params());
        self::assertEquals(FakeActionMap::DEFAULT_PARAMS, $arrayActionMap->params());
        self::assertNotEquals($overValues['_params'], $arrayActionMap->params());
        unset($overValues['_params']);
        self::assertNotEquals($this->mapValues['_params'], $arrayActionMap->params());
        unset($_REQUEST['_params']);
        self::assertEquals(FakeActionMap::DEFAULT_PARAMS, $arrayActionMap->params());

    }

}