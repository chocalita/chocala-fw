<?php

namespace Chocala\Http\Route;

use Chocala\Http\HttpMethod;
use Chocala\Http\Route\Fakes\FakeRoutes;
use PHPUnit\Framework\TestCase;
use TypeError;

class RoutesMappingTest extends TestCase
{
    /**
     * @var FakeRoutes
     */
    private FakeRoutes $fakeRoutes;

    public function setUp()
    {
        $this->fakeRoutes = new FakeRoutes();
    }

    public function test__construct()
    {
        $routesMapping = new RoutesMapping(new DefaultRoutes());
        self::assertNotNull($routesMapping);
        self::assertIsObject($routesMapping);
        self::assertInstanceOf(RoutesMappingInterface::class, $routesMapping);
        self::assertInstanceOf(RoutesMapping::class, $routesMapping);

        $routesMapping = new RoutesMapping($this->fakeRoutes);
        self::assertNotNull($routesMapping);
        self::assertIsObject($routesMapping);
        self::assertInstanceOf(RoutesMappingInterface::class, $routesMapping);
        self::assertInstanceOf(RoutesMapping::class, $routesMapping);

        $this->expectException(\ArgumentCountError::class);
        new RoutesMapping();
    }

    public function testInvalidHttpMethod()
    {
        $routesMapping = new RoutesMapping($this->fakeRoutes);
        $this->expectException(TypeError::class);
        $this->expectExceptionMessageRegExp('/Argument 2 passed to/');
        $routesMapping->realUri('/a/uri', 'X_METHOD');
    }

    public function testSimpleRealUri()
    {
        $routes = $this->fakeRoutes;
        $realRoute = $routes->routes()['/context-path/index'];
        $routesMapping = new RoutesMapping($routes);
        self::assertIsObject($routesMapping);
        $realUri = $routesMapping->realUri('/context-path/index', HttpMethod::GET());
        self::assertNotEmpty($realUri);
        self::assertIsString($realUri);
        self::assertEquals($realRoute, $realUri);
    }

    public function testRandomRealUri()
    {
        $key = '/Nk343Olt34Zp4/o1p0J6H7Re/RandomValue';
        $routesMapping = new RoutesMapping($this->fakeRoutes);
        self::assertIsObject($routesMapping);
        $realUri = $routesMapping->realUri($key, HttpMethod::GET());
        self::assertNotEmpty($realUri);
        self::assertIsString($realUri);
        self::assertEquals($key, $realUri);
    }

    public function testRealUriSet()
    {
        $routes = $this->fakeRoutes;
        $routesMapping = new RoutesMapping($routes);
        self::assertIsObject($routesMapping);

        $key = '/context-module/page/action/ID';
        $realUri = $routesMapping->realUri($key, HttpMethod::GET());
        self::assertNotEmpty($realUri);
        self::assertIsString($realUri);
        self::assertEquals($key, $realUri);

        $key = '/moduleX/pageX/actionX/99';
        $realUri = $routesMapping->realUri($key, HttpMethod::POST());
        self::assertNotEmpty($realUri);
        self::assertIsString($realUri);
        self::assertEquals($key, $realUri);

        $key = '/moduleX/pageX/actionX/';
        $realUri = $routesMapping->realUri($key, HttpMethod::POST());
        self::assertNotEmpty($realUri);
        self::assertIsString($realUri);
        self::assertEquals($key, $realUri);

        $key = '/context-path/index';
        $realUri = $routesMapping->realUri($key, HttpMethod::DELETE());
        self::assertNotEmpty($realUri);
        self::assertIsString($realUri);
        self::assertEquals('/moduleDef/controllerDef/actionDef/idDef', $realUri);

        $key = '/context-path/mod/ctrl';
        $realUri = $routesMapping->realUri($key, HttpMethod::POST());
        self::assertNotEmpty($realUri);
        self::assertIsString($realUri);
        self::assertEquals('/moduleTest/controllerTest/actionTest/idTest', $realUri);

        $key = '/context-path/http/methods';
        $realUri = $routesMapping->realUri($key, HttpMethod::GET());
        self::assertNotEmpty($realUri);
        self::assertIsString($realUri);
        self::assertEquals('/module/controller/getAction', $realUri);

        $key = '/context-path/http/methods';
        $realUri = $routesMapping->realUri($key, HttpMethod::POST());
        self::assertNotEmpty($realUri);
        self::assertIsString($realUri);
        self::assertEquals('/module/controller/postAction', $realUri);

        $key = '/context-path/http/methods';
        $realUri = $routesMapping->realUri($key, HttpMethod::PUT());
        self::assertNotEmpty($realUri);
        self::assertIsString($realUri);
        self::assertEquals('/module/controller/putAction', $realUri);

        $key = '/context-path/http/methods';
        $realUri = $routesMapping->realUri($key, HttpMethod::PATCH());
        self::assertNotEmpty($realUri);
        self::assertIsString($realUri);
        self::assertEquals('/module/controller/patchAction', $realUri);

        $key = '/context-path/http/methods';
        $realUri = $routesMapping->realUri($key, HttpMethod::DELETE());
        self::assertNotEmpty($realUri);
        self::assertIsString($realUri);
        self::assertEquals('/module/controller/deleteAction', $realUri);

        // matches with -> /context-path/entity/{id}
        $key = '/context-path/entity/9';
        $realUri = $routesMapping->realUri($key, HttpMethod::DELETE());
        self::assertNotEmpty($realUri);
        self::assertIsString($realUri);
        self::assertEquals('/moduleTest/controllerTest/actionTest/{id}', $realUri);

        // matches with -> /context-path/my-{controller}/{id}
        // {controller} -> profile
        $key = '/context-path/my-profile/9';
        $realUri = $routesMapping->realUri($key, HttpMethod::PUT());
        self::assertNotEmpty($realUri);
        self::assertIsString($realUri);
        self::assertEquals('/moduleTest/{controller}/myActionTest/{id}', $realUri);

        // matches with -> /context-path/connect-{module}/{id}
        // {module} -> admin
        $key = '/context-path/connect-admin/9';
        $realUri = $routesMapping->realUri($key, HttpMethod::GET());
        self::assertNotEmpty($realUri);
        self::assertIsString($realUri);
        self::assertEquals('/{module}/connect/getAction/{id}', $realUri);

        // matches with -> /context-path/connect-{module}/{id}
        // {module} -> admin
        $key = '/context-path/connect-admin/9';
        $realUri = $routesMapping->realUri($key, HttpMethod::POST());
        self::assertNotEmpty($realUri);
        self::assertIsString($realUri);
        self::assertEquals('/{module}/connect/postAction/{id}', $realUri);
    }
}
