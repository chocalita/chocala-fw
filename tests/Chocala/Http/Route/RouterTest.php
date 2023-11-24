<?php

namespace Chocala\Http\Route;

use Chocala\Http\Route\Fakes\FakeRoutes;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{

    private $fakeRoutes;

    public function setUp()
    {
        $this->fakeRoutes = new FakeRoutes();
    }

/*    public function testRouteDefaultRoutes()
    {
        $routes = new DefaultRoutes();
        $realRoute = $routes->routes()['/contact'];
        $router = new Router($routes, '/contact', 'GET');
        self::assertIsObject($router);
        self::assertEquals($realRoute, $router->realUri());
    }

    public function testRouteRandomURI()
    {
        $routes = new DefaultRoutes();
        $key = '/Nk343Olt34Zp4/o1p0J6H7Re/RandomValue';
        $router = new Router($routes, $key, 'GET');
        self::assertIsObject($router);
        self::assertEquals($key, $router->realUri());
    }*/

    public function testRoutesCustomClass()
    {
        $routes = $this->fakeRoutes;

        $key = '/context-module/page/action/ID';
        $router = new Router($routes, $key, 'GET');
        self::assertIsObject($router);
//        self::assertEquals($key, $router->realUri());

        $actionMap = $router->resolvedUri();
        self::assertEquals('context-module', $actionMap->module());
        self::assertEquals('page', $actionMap->controller());
        self::assertEquals('action', $actionMap->action());
        self::assertEquals('ID', $actionMap->id());


        $key = '/moduleX/pageX/actionX/99';
        $router = new Router($routes, $key, 'POST');
        self::assertIsObject($router);
//        self::assertEquals($key, $router->realUri());

        $actionMap = $router->resolvedUri();
        self::assertEquals('moduleX', $actionMap->module());
        self::assertEquals('pageX', $actionMap->controller());
        self::assertEquals('actionX', $actionMap->action());
        self::assertEquals(99, $actionMap->id());


        $key = '/moduleX/pageX/actionX/';
        $router = new Router($routes, $key, 'POST');
        self::assertIsObject($router);
//        self::assertEquals($key, $router->realUri());

        $actionMap = $router->resolvedUri();
        self::assertEquals('moduleX', $actionMap->module());
        self::assertEquals('pageX', $actionMap->controller());
        self::assertEquals('actionX', $actionMap->action());
        self::assertEmpty($actionMap->id());


        $key = '/context-path/index';
        $router = new Router($routes, $key, 'DELETE');
        self::assertIsObject($router);
//        self::assertEquals('/moduleDef/controllerDef/actionDef/idDef', $router->realUri());

        $actionMap = $router->resolvedUri();
        self::assertEquals('moduleDef', $actionMap->module());
        self::assertEquals('controllerDef', $actionMap->controller());
        self::assertEquals('actionDef', $actionMap->action());
        self::assertEquals('idDef', $actionMap->id());


        $key = '/context-path/mod/ctrl';
        $router = new Router($routes, $key, 'POST');
        self::assertIsObject($router);
//        self::assertEquals('/moduleTest/controllerTest/actionTest/idTest', $router->realUri());

        $actionMap = $router->resolvedUri();
        self::assertEquals('moduleTest', $actionMap->module());
        self::assertEquals('controllerTest', $actionMap->controller());
        self::assertEquals('actionTest', $actionMap->action());
        self::assertEquals('idTest', $actionMap->id());


        $key = '/context-path/http/methods';
        $router = new Router($routes, $key, 'GET');
        self::assertIsObject($router);
//        self::assertEquals('/module/controller/getAction', $router->realUri());

        $actionMap = $router->resolvedUri();
        self::assertEquals('module', $actionMap->module());
        self::assertEquals('controller', $actionMap->controller());
        self::assertEquals('getAction', $actionMap->action());
        self::assertEmpty($actionMap->id());


        $key = '/context-path/http/methods';
        $router = new Router($routes, $key, 'POST');
        self::assertIsObject($router);
//        self::assertEquals('/module/controller/postAction', $router->realUri());

        $actionMap = $router->resolvedUri();
        self::assertEquals('module', $actionMap->module());
        self::assertEquals('controller', $actionMap->controller());
        self::assertEquals('postAction', $actionMap->action());
        self::assertEmpty($actionMap->id());


        $key = '/context-path/http/methods';
        $router = new Router($routes, $key, 'PUT');
        self::assertIsObject($router);
//        self::assertEquals('/module/controller/putAction', $router->realUri());

        $actionMap = $router->resolvedUri();
        self::assertEquals('module', $actionMap->module());
        self::assertEquals('controller', $actionMap->controller());
        self::assertEquals('putAction', $actionMap->action());
        self::assertEmpty($actionMap->id());


        $key = '/context-path/http/methods';
        $router = new Router($routes, $key, 'PATCH');
        self::assertIsObject($router);
//        self::assertEquals('/module/controller/patchAction', $router->realUri());

        $actionMap = $router->resolvedUri();
        self::assertEquals('module', $actionMap->module());
        self::assertEquals('controller', $actionMap->controller());
        self::assertEquals('patchAction', $actionMap->action());
        self::assertEmpty($actionMap->id());


        $key = '/context-path/http/methods';
        $router = new Router($routes, $key, 'DELETE');
        self::assertIsObject($router);
//        self::assertEquals('/module/controller/deleteAction', $router->realUri());

        $actionMap = $router->resolvedUri();
        self::assertEquals('module', $actionMap->module());
        self::assertEquals('controller', $actionMap->controller());
        self::assertEquals('deleteAction', $actionMap->action());
        self::assertEmpty($actionMap->id());
    }

    public function testResolvedUriRoutesCustomClass()
    {
        $routes = $this->fakeRoutes;

        $key = '/moduleX/pageX/actionX/';
        $router = new Router($routes, $key, 'POST');
        self::assertIsObject($router);
//        self::assertEquals($key, $router->realUri());

        $uri = $router->resolvedUri();
        self::assertEquals('moduleX', $uri->module());
        self::assertEquals('pageX', $uri->controller());
        self::assertEquals('actionX', $uri->action());
        self::assertEquals('', $uri->id());
    }


    public function testRouteCFDDAS()
    {
        $routes = $this->fakeRoutes;
        $key = '/view/activate';
        $router = new Router($routes, $key, 'GET');
        self::assertIsObject($router);
//        self::assertEquals($key, $router->realUri());

        $m = $router->resolvedUri();
    }

}
