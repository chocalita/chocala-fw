<?php

namespace Chocala\Http\Mapping;

use ArgumentCountError;
use Chocala\Http\Route\DefaultRoutes;
use Chocala\Http\Route\Fakes\FakeRoutes;
use Chocala\Http\Route\RoutesInterface;
use PHPUnit\Framework\TestCase;

class UriMappingTest extends TestCase
{
    /**
     * @var FakeRoutes
     */
    private RoutesInterface $fakeRoutes;

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

        $this->expectException(ArgumentCountError::class);
        new UriMapping();
    }

    public function testMatchCase()
    {
        $uriMapping = new UriMapping($this->fakeRoutes);

        $matchCase = $uriMapping->matchCase('/contact');
        self::assertIsArray($matchCase);
        self::assertEmpty($matchCase);


        $matchCase = $uriMapping->matchCase('/X{module}/{controller}/{action}');
        self::assertIsArray($matchCase);
        self::assertNotEmpty($matchCase);
        self::assertCount(1, $matchCase);
        $mapping = reset($matchCase);
        self::assertIsString($mapping);
        self::assertEquals('/{module}/{controller}/{action}/{id}', $mapping);

        $matchCase = $uriMapping->matchCase('/X{module}/{controller}/{action}');
        self::assertIsArray($matchCase);
        self::assertNotEmpty($matchCase);
        self::assertCount(1, $matchCase);
        $mapping = reset($matchCase);
        self::assertIsString($mapping);
        self::assertEquals('/{module}/{controller}/{action}/{id}', $mapping);

        $matchCase = $uriMapping->matchCase('/view/any');
        self::assertIsArray($matchCase);
        self::assertNotEmpty($matchCase);
        self::assertCount(1, $matchCase);
        $mapping = reset($matchCase);
        self::assertIsString($mapping);
        self::assertEquals('/moduleX/controllerX/{action}', $mapping);

        $matchCase = $uriMapping->matchCase('/view');
        self::assertIsArray($matchCase);
        self::assertNotEmpty($matchCase);
        self::assertCount(1, $matchCase);
        $mapping = reset($matchCase);
        self::assertIsArray($mapping);
        self::assertCount(3, $mapping);

        $matchCase = $uriMapping->matchCase('/view/foo');
        self::assertIsArray($matchCase);
        self::assertNotEmpty($matchCase);
        self::assertCount(1, $matchCase);
        $mapping = reset($matchCase);
        self::assertIsArray($mapping);
        self::assertCount(4, $mapping);

        $matchCase = $uriMapping->matchCase('/map');
        self::assertIsArray($matchCase);
        self::assertNotEmpty($matchCase);
        self::assertCount(1, $matchCase);
        $mapping = reset($matchCase);
        self::assertIsArray($mapping);
        self::assertCount(3, $mapping);

        print_r($matchCase);
    }
}
