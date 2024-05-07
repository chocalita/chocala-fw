<?php

namespace Chocala\Http\Mapping;

interface ActionMappingInterface
{
    public function actionMap(string $uri): ActionMapInterface;
}
