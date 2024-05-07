<?php

namespace Chocala\Http\Route\Fakes;

use Chocala\http\Route\RoutesInterface;
use Chocala\http\Route\Routing;

class FakeRoutes implements RoutesInterface
{
    use Routing;

    protected string $urlPattern = '/{module}/{controller}/{action}/{id}';

    protected array $mapping = [
        '/X{module}/{controller}/{action}' => '/{module}/{controller}/{action}/{id}',
        '/my{controller}/{action}' => '/myModule/{controller}/{action}/{id}',
        //'/{controller}/{action}' => '/moduleX/{controller}/{action}',
        '/view/{action}' => '/moduleX/controllerX/{action}',
        '/view' => ['module' => 'viewModule', 'controller' => 'viewController', 'action' => 'viewAction'],
        '/view/foo' => ['module' => 'myModule', 'controller' => 'myController', 'action' => 'myAction', 'id' => 'foo'],
        '/map' => ['module' => 'portal', 'controller' => 'page', 'action' => 'map']
    ];

    protected array $routes = [
        '/context-path/index' => '/moduleDef/controllerDef/actionDef/idDef',
        '/context-path/mod/ctrl' => '/moduleTest/controllerTest/actionTest/idTest',
        '/context-path/entity/{id}' => '/moduleTest/controllerTest/actionTest/{id}',
        '/context-path/my-{controller}/{id}' => '/moduleTest/{controller}/myActionTest/{id}',
        '/context-path/http/methods' => [
            'GET' => '/module/controller/getAction',
            'POST' => '/module/controller/postAction',
            'PUT' => '/module/controller/putAction',
            'PATCH' => '/module/controller/patchAction',
            'DELETE' => '/module/controller/deleteAction'
        ],
        '/context-path/connect-{module}/{id}' => [
            'GET' => '/{module}/connect/getAction/{id}',
            'POST' => '/{module}/connect/postAction/{id}'
        ],
        '/contact' => '/pages/landing/contact'
    ];
}
