<?php

namespace Chocala\Http\Mapping\Fakes;

use Chocala\Http\Mapping\ActionMap;

class FakeActionMap extends ActionMap
{
    /**
     * @var ActionMap wrapped fake object
     */
    private ActionMap $actionMap;

    public const DEFAULT_MODULE = 'fooModule';
    public const DEFAULT_CONTROLLER = 'fooController';
    public const DEFAULT_ACTION = 'fooAction';
    public const DEFAULT_ID = 'fooId';
    public const DEFAULT_PARAMS = ['param1' => 'fooValue1', 'param2' => 'fooValue2', 'paramX' => 'fooValueY'];

    public function __construct()
    {
        $this->actionMap = new ActionMap(
            self::DEFAULT_MODULE,
            self::DEFAULT_CONTROLLER,
            self::DEFAULT_ACTION,
            self::DEFAULT_ID,
            self::DEFAULT_PARAMS
        );
    }

    public function module(): string
    {
        return $this->actionMap->module();
    }

    public function controller(): string
    {
        return $this->actionMap->controller();
    }

    public function action(): string
    {
        return $this->actionMap->action();
    }

    public function id()
    {
        return $this->actionMap->id();
    }

    public function params(): array
    {
        return $this->actionMap->params();
    }
}
