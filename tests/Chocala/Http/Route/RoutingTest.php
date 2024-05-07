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

    private function routingClass(): RoutesInterface
    {
        return new class () implements RoutesInterface {
            use Routing;

            protected string $urlPattern = '/{module}/{controller}/{action}/{id}';

            protected array $mapping = [
            ];
        };
    }

    private function emptyDefaultMapRoutingClass(): RoutesInterface
    {
        return new class () implements RoutesInterface {
            use Routing;

            protected string $urlPattern = '';
        };
    }

    private function invalidPathDefaultMapRoutingClass(): RoutesInterface
    {
        return new class () implements RoutesInterface {
            use Routing;

            protected string $urlPattern = 'noPathValue';
        };
    }

    private function undefinedMappingRoutingClass(): RoutesInterface
    {
        return new class () implements RoutesInterface {
            use Routing;

            protected string $urlPattern = '/a/valid/path';
        };
    }
}
