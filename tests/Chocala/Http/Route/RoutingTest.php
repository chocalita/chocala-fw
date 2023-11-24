<?php

namespace Chocala\Http\Route;

use PHPUnit\Framework\TestCase;

class RoutingTest extends TestCase
{

    public function testRoutingClass()
    {
        $routingClass = $this->routingClass();
        $this->assertNotEmpty($routingClass->urlPattern());
        $this->assertIsArray($routingClass->mapping());
    }

    public function testEmptyDefaultMap()
    {
        $oo = $this->emptyDefaultMapRoutingClass();
        $this->expectException(\InvalidArgumentException::class);
        $oo->urlPattern();
    }

    public function testNoPathDefaultMap()
    {
        $oo = $this->invalidPathDefaultMapRoutingClass();
        $this->expectException(\InvalidArgumentException::class);
        $oo->urlPattern();
    }

    public function testUndefinedMapping()
    {
        $oo = $this->undefinedMappingRoutingClass();
        $this->expectException(\InvalidArgumentException::class);
        $oo->mapping();
    }

    public function testUndefinedRoutes()
    {
        $oo = $this->undefinedMappingRoutingClass();
        $this->expectException(\InvalidArgumentException::class);
        $oo->routes();
    }

    private function routingClass()
    {
        return new class() implements RoutesInterface {
            use Routing;

            protected $urlPattern = '/{module}/{controller}/{action}/{id}';

            protected $mapping = [
            ];

        };
    }

    private function emptyDefaultMapRoutingClass()
    {
        return new class() implements RoutesInterface {
            use Routing;

            protected $urlPattern = '';

        };
    }

    private function invalidPathDefaultMapRoutingClass()
    {
        return new class() implements RoutesInterface {
            use Routing;

            protected $urlPattern = 'noPathValue';

        };
    }

    private function undefinedMappingRoutingClass()
    {
        return new class() implements RoutesInterface {
            use Routing;

            protected $urlPattern = '/a/valid/path';

        };
    }

}