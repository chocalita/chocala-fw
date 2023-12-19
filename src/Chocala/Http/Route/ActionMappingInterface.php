<?php

namespace Chocala\Http\Route;

use Chocala\Http\Mapping\ActionMapInterface;

interface ActionMappingInterface
{

    public function actionMap(string $uri): ActionMapInterface;

}