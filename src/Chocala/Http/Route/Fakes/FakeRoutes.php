<?php

namespace Chocala\Http\Route\Fakes;

use Chocala\http\Route\RoutesInterface;
use Chocala\http\Route\Routing;

class FakeRoutes implements RoutesInterface
{
    use Routing;

    protected string $urlPattern = '/{module}/{controller}/{action}/{id}';

    protected array $mapping = [
        '/X{module}/{controller}/{action}' => 'threeParam',
        '/my{controller}/{action}' => 'twoParam',
        '/view/{action}' => '/moduleX/controllerX/{action}',
        '/view' => ['module' => ''],
        '/view/tiktok' => ['module' => 'myModule', 'controller' => 'myController', 'action' => 'myAction'],
        'x' => 'y'
    ];

    protected array $routes = [
        '/context-path/index' => '/moduleDef/controllerDef/actionDef/idDef',
        '/context-path/mod/ctrl' => '/moduleTest/controllerTest/actionTest/idTest',
        '/context-path/entity/{id}' => '/moduleTest/controllerTest/actionTest/{id}',
        '/context-path/http/methods' => [
            'GET' => '/module/controller/getAction',
            'POST' => '/module/controller/postAction',
            'PUT' => '/module/controller/putAction',
            'PATCH' => '/module/controller/patchAction',
            'DELETE' => '/module/controller/deleteAction'
        ]
    ];

}