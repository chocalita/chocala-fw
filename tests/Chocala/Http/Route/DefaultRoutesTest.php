<?php

namespace Chocala\Http\Route;

use Chocala\Http\Mapping\PatternMap;
use PHPUnit\Framework\TestCase;

class DefaultRoutesTest extends TestCase
{
    public function testClassValues()
    {
        $defaultRoutes = new DefaultRoutes();

        self::assertIsArray($defaultRoutes->mapping());
        self::assertNotEmpty($defaultRoutes->mapping());
        self::assertIsArray($defaultRoutes->routes());
        self::assertNotEmpty($defaultRoutes->routes());
        self::assertArrayHasKey('/', $defaultRoutes->routes());
    }

    public function testDefaultMap()
    {
        $defaultRoutes = new DefaultRoutes();
        $patternMap = new PatternMap($defaultRoutes->urlPattern());

        self::assertNotEmpty($patternMap->pattern());
        self::assertNotEmpty($patternMap->map());
        self::assertIsArray($patternMap->map());
        self::assertContains('controller', $patternMap->map());
        self::assertContains('action', $patternMap->map());
    }
}
