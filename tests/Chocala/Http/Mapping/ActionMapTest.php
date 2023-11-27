<?php

namespace Chocala\Http\Mapping;

use PHPUnit\Framework\TestCase;

class ActionMapTest extends TestCase
{

    private string $module = "testModule";
    private string $controller = "testController";
    private string $action = "testAction";
    private int $id = 1000;
    private array $params = ['paramA', 'paramB'];

    public function testCreations()
    {
        $actionMap3 = new ActionMap($this->module, $this->controller, $this->action);
        self::assertEquals($this->module, $actionMap3->module());
        self::assertEquals($this->controller, $actionMap3->controller());
        self::assertEquals($this->action, $actionMap3->action());
        self::assertNull($actionMap3->id());
        self::assertEmpty($actionMap3->params());

        $actionMap4 = new ActionMap($this->module, $this->controller, $this->action, $this->params);
        self::assertEquals($this->module, $actionMap4->module());
        self::assertEquals($this->controller, $actionMap4->controller());
        self::assertEquals($this->action, $actionMap4->action());
        self::assertNull($actionMap4->id());
        self::assertEquals($this->params, $actionMap4->params());
        self::assertCount(2, $actionMap4->params());

        $actionMap5 = new ActionMap($this->module, $this->controller, $this->action, $this->id, $this->params);
        self::assertEquals($this->module, $actionMap5->module());
        self::assertEquals($this->controller, $actionMap5->controller());
        self::assertEquals($this->action, $actionMap5->action());
        self::assertEquals($this->id, $actionMap5->id());
        self::assertEquals($this->params, $actionMap5->params());
    }

    public function testInvalidCreation()
    {
        $this->expectException(\InvalidArgumentException::class);
        new ActionMap($this->module, $this->controller);
    }

}