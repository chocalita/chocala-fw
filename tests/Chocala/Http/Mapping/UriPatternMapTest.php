<?php

namespace Chocala\Http\Mapping;

use Chocala\Http\Route\DefaultRoutes;
use Chocala\Http\Route\Fakes\FakeRoutes;
use PHPUnit\Framework\TestCase;

class UriPatternMapTest extends TestCase
{

    /**
     * @var DefaultRoutes
     */
    private $defaultRoutes;

    /**
     * @var FakeRoutes
     */
    private $fakeRoutes;

    public function setUp()
    {
        $this->defaultRoutes = new DefaultRoutes();
        $this->fakeRoutes = new FakeRoutes();
    }

    public function test__construct()
    {
        $uriPatternMap = new UriPatternMap($this->defaultRoutes);
        self::assertNotNull($uriPatternMap);
        self::assertIsObject($uriPatternMap);
        self::assertInstanceOf(UriPatternMap::class, $uriPatternMap);

        $this->expectException(\ArgumentCountError::class);
        new UriPatternMap();
    }

/*    public function testSimpleRealUri()
    {
        $routes = $this->defaultRoutes;
        $realRoute = $routes->mapping()['/contact'];
        $uriPatternMap = new UriPatternMap($routes);
        self::assertIsObject($uriPatternMap);
        $realUri = $uriPatternMap->matchCase('/contact');
        self::assertNotEmpty($realUri);
        self::assertIsString($realUri);
        self::assertEquals($realRoute, $realUri);
    }*/


}
