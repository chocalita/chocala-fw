<?php

namespace Chocala\Http\Mapping;

class LinkedActionMap implements ActionMapInterface
{
    /**
     * @var array
     */
    private array $map;

    /**
     * @var ActionMapInterface
     */
    private ActionMapInterface $actionMap;

    /**
     * @param array $map
     * @param ActionMapInterface $actionMap
     */
    public function __construct(array &$map, ActionMapInterface $actionMap)
    {
        $this->map = &$map;
        $this->actionMap = $actionMap;
    }

    public function module(): string
    {
        return $this->map['_module'] ?? $this->actionMap->module();
    }

    public function controller(): string
    {
        return $this->map['_controller'] ?? $this->actionMap->controller();
    }

    public function action(): string
    {
        return $this->map['_action'] ?? $this->actionMap->action();
    }

    public function id()
    {
        return $this->map['_id'] ?? $this->actionMap->id();
    }

    public function params(): array
    {
        return $this->actionMap->params();
    }
}
