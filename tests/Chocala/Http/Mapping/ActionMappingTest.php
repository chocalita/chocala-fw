<?php

namespace Chocala\Http\Mapping;

use Chocala\Http\HttpMethod;
use Chocala\Http\Route\DefaultRoutes;
use Chocala\Http\Route\Fakes\FakeRoutes;
use Chocala\Http\Route\RoutesMapping;
use Chocala\Http\Route\RoutesMappingInterface;
use Exception;
use PHPUnit\Framework\TestCase;

class ActionMappingTest extends TestCase
{

    private ActionMapping $actionMapping;

    private RoutesMappingInterface $routesNapping;

    public function setUp()
    {
        $fakeRoutes = new FakeRoutes();
        $this->actionMapping = new ActionMapping($fakeRoutes);
        $this->routesNapping = new RoutesMapping($fakeRoutes);
    }

    public function test__construct()
    {
        $actionMapping = new ActionMapping(new DefaultRoutes());
        self::assertNotNull($actionMapping);
        self::assertIsObject($actionMapping);
        self::assertInstanceOf(ActionMappingInterface::class, $actionMapping);
        self::assertInstanceOf(ActionMapping::class, $actionMapping);

        $actionMapping = $this->actionMapping;
        self::assertNotNull($actionMapping);
        self::assertIsObject($actionMapping);
        self::assertInstanceOf(ActionMappingInterface::class, $actionMapping);
        self::assertInstanceOf(ActionMapping::class, $actionMapping);
    }

    /*
        public function testRouteRandomURI()
        {
            $routes = new DefaultRoutes();
            $key = '/Nk343Olt34Zp4/o1p0J6H7Re/RandomValue';
            $router = new Router($routes, $key, 'GET');
            self::assertIsObject($router);
            self::assertEquals($key, $router->realUri());
        }*/

    /**
     * @throws Exception
     */
    public function testActionMap()
    {

        $uri = '/moduleX/pageY/actionZ/1';
        $actionMap = $this->actionMapping->actionMap($uri);

        self::assertEquals('moduleX', $actionMap->module());
        self::assertEquals('pageY', $actionMap->controller());
        self::assertEquals('actionZ', $actionMap->action());
        self::assertEquals('1', $actionMap->id());


        $uri = '/moduleX/pageX/actionX/';
        $actionMap = $this->actionMapping->actionMap($uri);

        self::assertEquals('moduleX', $actionMap->module());
        self::assertEquals('pageX', $actionMap->controller());
        self::assertEquals('actionX', $actionMap->action());
        self::assertEquals('', $actionMap->id());


        $uri = '/module/controller/action/1/param=value&x=y';
        $actionMap = $this->actionMapping->actionMap($uri);

        self::assertEquals('module', $actionMap->module());
        self::assertEquals('controller', $actionMap->controller());
        self::assertEquals('action', $actionMap->action());
        self::assertEquals('1', $actionMap->id());
        // TODO: fill and evaluate params
        self::assertEquals([], $actionMap->params());
    }

    /**
     * @throws Exception
     */
    public function testWithRoutesNapping()
    {
        self::assertIsObject($this->actionMapping);

        $key = '/context-module/page/action/ID';
        $uri = $this->routesNapping->realUri($key, HttpMethod::GET());

        $actionMap = $this->actionMapping->actionMap($uri);
        self::assertEquals('context-module', $actionMap->module());
        self::assertEquals('page', $actionMap->controller());
        self::assertEquals('action', $actionMap->action());
        self::assertEquals('ID', $actionMap->id());


        $key = '/moduleX/pageX/actionX/99';
        $uri = $this->routesNapping->realUri($key, HttpMethod::POST());

        $actionMap = $this->actionMapping->actionMap($uri);
        self::assertEquals('moduleX', $actionMap->module());
        self::assertEquals('pageX', $actionMap->controller());
        self::assertEquals('actionX', $actionMap->action());
        self::assertEquals(99, $actionMap->id());


        $key = '/moduleX/pageX/actionX/';
        $uri = $this->routesNapping->realUri($key, HttpMethod::POST());

        $actionMap = $this->actionMapping->actionMap($key);
        self::assertEquals('moduleX', $actionMap->module());
        self::assertEquals('pageX', $actionMap->controller());
        self::assertEquals('actionX', $actionMap->action());
        self::assertEmpty($actionMap->id());


        $key = '/context-path/index';
        $uri = $this->routesNapping->realUri($key, HttpMethod::DELETE());

        $actionMap = $this->actionMapping->actionMap($uri);
        self::assertEquals('moduleDef', $actionMap->module());
        self::assertEquals('controllerDef', $actionMap->controller());
        self::assertEquals('actionDef', $actionMap->action());
        self::assertEquals('idDef', $actionMap->id());


        $key = '/context-path/mod/ctrl';
        $uri = $this->routesNapping->realUri($key, HttpMethod::POST());

        $actionMap = $this->actionMapping->actionMap($uri);
        self::assertEquals('moduleTest', $actionMap->module());
        self::assertEquals('controllerTest', $actionMap->controller());
        self::assertEquals('actionTest', $actionMap->action());
        self::assertEquals('idTest', $actionMap->id());


        $key = '/context-path/http/methods';
        $uri = $this->routesNapping->realUri($key, HttpMethod::GET());

        $actionMap = $this->actionMapping->actionMap($uri);
        self::assertEquals('module', $actionMap->module());
        self::assertEquals('controller', $actionMap->controller());
        self::assertEquals('getAction', $actionMap->action());
        self::assertEmpty($actionMap->id());


        $key = '/context-path/http/methods';
        $uri = $this->routesNapping->realUri($key, HttpMethod::POST());

        $actionMap = $this->actionMapping->actionMap($uri);
        self::assertEquals('module', $actionMap->module());
        self::assertEquals('controller', $actionMap->controller());
        self::assertEquals('postAction', $actionMap->action());
        self::assertEmpty($actionMap->id());


        $key = '/context-path/http/methods';
        $uri = $this->routesNapping->realUri($key, HttpMethod::PUT());

        $actionMap = $this->actionMapping->actionMap($uri);
        self::assertEquals('module', $actionMap->module());
        self::assertEquals('controller', $actionMap->controller());
        self::assertEquals('putAction', $actionMap->action());
        self::assertEmpty($actionMap->id());


        $key = '/context-path/http/methods';
        $uri = $this->routesNapping->realUri($key, HttpMethod::PATCH());

        $actionMap = $this->actionMapping->actionMap($uri);
        self::assertEquals('module', $actionMap->module());
        self::assertEquals('controller', $actionMap->controller());
        self::assertEquals('patchAction', $actionMap->action());
        self::assertEmpty($actionMap->id());


        $key = '/context-path/http/methods';
        $uri = $this->routesNapping->realUri($key, HttpMethod::DELETE());

        $actionMap = $this->actionMapping->actionMap($uri);
        self::assertEquals('module', $actionMap->module());
        self::assertEquals('controller', $actionMap->controller());
        self::assertEquals('deleteAction', $actionMap->action());
        self::assertEmpty($actionMap->id());

        $key = '/contact';
        $uri = $this->routesNapping->realUri($key, HttpMethod::GET());

        $actionMap = $this->actionMapping->actionMap($uri);
        self::assertEquals('pages', $actionMap->module());
        self::assertEquals('landing', $actionMap->controller());
        self::assertEquals('contact', $actionMap->action());
        self::assertEmpty($actionMap->id());
    }

}