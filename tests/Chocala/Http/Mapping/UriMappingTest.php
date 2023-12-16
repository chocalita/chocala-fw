<?php

namespace Chocala\Http\Mapping;

use Chocala\Http\HttpMethod;
use Chocala\Http\Route\DefaultRoutes;
use Chocala\Http\Route\Fakes\FakeRoutes;
use PHPUnit\Framework\TestCase;
use TypeError;

class UriMappingTest extends TestCase
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
        $uriMapping = new UriMapping(new DefaultRoutes());
        self::assertNotNull($uriMapping);
        self::assertIsObject($uriMapping);
        self::assertInstanceOf(UriMappingInterface::class, $uriMapping);
        self::assertInstanceOf(UriMapping::class, $uriMapping);

        $uriMapping = new UriMapping($this->fakeRoutes);
        self::assertNotNull($uriMapping);
        self::assertIsObject($uriMapping);
        self::assertInstanceOf(UriMappingInterface::class, $uriMapping);
        self::assertInstanceOf(UriMapping::class, $uriMapping);

        $this->expectException(\ArgumentCountError::class);
        new UriMapping();
    }

    public function testInvalidHttpMethod()
    {
        $uriMapping = new UriMapping($this->fakeRoutes);
        $this->expectException(TypeError::class);
        $this->expectExceptionMessageRegExp('/Argument 2 passed to/');
        $uriMapping->realUri('/a/uri', 'X_METHOD');
    }

    public function testSimpleRealUri()
    {
        $routes = $this->fakeRoutes;
        $realRoute = $routes->routes()['/context-path/index'];
        $uriMapping = new UriMapping($routes);
        self::assertIsObject($uriMapping);
        $realUri = $uriMapping->realUri('/context-path/index', HttpMethod::GET());
        self::assertNotEmpty($realUri);
        self::assertIsString($realUri);
        self::assertEquals($realRoute, $realUri);
    }

    public function testRandomRealUri()
    {
        $key = '/Nk343Olt34Zp4/o1p0J6H7Re/RandomValue';
        $uriMapping = new UriMapping($this->fakeRoutes);
        self::assertIsObject($uriMapping);
        $realUri = $uriMapping->realUri($key, HttpMethod::GET());
        self::assertNotEmpty($realUri);
        self::assertIsString($realUri);
        self::assertEquals($key, $realUri);
    }

    public function testRealUriSet()
    {
        $routes = $this->fakeRoutes;
        $uriMapping = new UriMapping($routes);
        self::assertIsObject($uriMapping);

        $key = '/context-module/page/action/ID';
        $realUri = $uriMapping->realUri($key, HttpMethod::GET());
        self::assertNotEmpty($realUri);
        self::assertIsString($realUri);
        self::assertEquals($key, $realUri);

        $key = '/moduleX/pageX/actionX/99';
        $realUri = $uriMapping->realUri($key, HttpMethod::POST());
        self::assertNotEmpty($realUri);
        self::assertIsString($realUri);
        self::assertEquals($key, $realUri);

        $key = '/moduleX/pageX/actionX/';
        $realUri = $uriMapping->realUri($key, HttpMethod::POST());
        self::assertNotEmpty($realUri);
        self::assertIsString($realUri);
        self::assertEquals($key, $realUri);

        $key = '/context-path/index';
        $realUri = $uriMapping->realUri($key, HttpMethod::DELETE());
        self::assertNotEmpty($realUri);
        self::assertIsString($realUri);
        self::assertEquals('/moduleDef/controllerDef/actionDef/idDef', $realUri);

        $key = '/context-path/mod/ctrl';
        $realUri = $uriMapping->realUri($key, HttpMethod::POST());
        self::assertNotEmpty($realUri);
        self::assertIsString($realUri);
        self::assertEquals('/moduleTest/controllerTest/actionTest/idTest', $realUri);

        $key = '/context-path/http/methods';
        $realUri = $uriMapping->realUri($key, HttpMethod::GET());
        self::assertNotEmpty($realUri);
        self::assertIsString($realUri);
        self::assertEquals('/module/controller/getAction', $realUri);

        $key = '/context-path/http/methods';
        $realUri = $uriMapping->realUri($key, HttpMethod::POST());
        self::assertNotEmpty($realUri);
        self::assertIsString($realUri);
        self::assertEquals('/module/controller/postAction', $realUri);

        $key = '/context-path/http/methods';
        $realUri = $uriMapping->realUri($key, HttpMethod::PUT());
        self::assertNotEmpty($realUri);
        self::assertIsString($realUri);
        self::assertEquals('/module/controller/putAction', $realUri);

        $key = '/context-path/http/methods';
        $realUri = $uriMapping->realUri($key, HttpMethod::PATCH());
        self::assertNotEmpty($realUri);
        self::assertIsString($realUri);
        self::assertEquals('/module/controller/patchAction', $realUri);

        $key = '/context-path/http/methods';
        $realUri = $uriMapping->realUri($key, HttpMethod::DELETE());
        self::assertNotEmpty($realUri);
        self::assertIsString($realUri);
        self::assertEquals('/module/controller/deleteAction', $realUri);

        // matches with -> /context-path/entity/{id}
        $key = '/context-path/entity/9';
        $realUri = $uriMapping->realUri($key, HttpMethod::DELETE());
        self::assertNotEmpty($realUri);
        self::assertIsString($realUri);
        self::assertEquals('/moduleTest/controllerTest/actionTest/{id}', $realUri);

        // matches with -> /context-path/my-{controller}/{id}
        // {controller} -> profile
        $key = '/context-path/my-profile/9';
        $realUri = $uriMapping->realUri($key, HttpMethod::PUT());
        self::assertNotEmpty($realUri);
        self::assertIsString($realUri);
        self::assertEquals('/moduleTest/{controller}/myActionTest/{id}', $realUri);

        // matches with -> /context-path/connect-{module}/{id}
        // {module} -> admin
        $key = '/context-path/connect-admin/9';
        $realUri = $uriMapping->realUri($key, HttpMethod::GET());
        self::assertNotEmpty($realUri);
        self::assertIsString($realUri);
        self::assertEquals('/{module}/connect/getAction/{id}', $realUri);

        // matches with -> /context-path/connect-{module}/{id}
        // {module} -> admin
        $key = '/context-path/connect-admin/9';
        $realUri = $uriMapping->realUri($key, HttpMethod::POST());
        self::assertNotEmpty($realUri);
        self::assertIsString($realUri);
        self::assertEquals('/{module}/connect/postAction/{id}', $realUri);
    }

}
