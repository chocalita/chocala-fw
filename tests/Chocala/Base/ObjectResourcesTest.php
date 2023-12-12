<?php

namespace Chocala\Base;

use PHPUnit\Framework\TestCase;

class ObjectResourcesTest extends TestCase
{

    public function test__construct()
    {
        $objectResources = new ObjectResources();
        self::assertNotNull($objectResources);
        self::assertIsObject($objectResources);
        self::assertInstanceOf(ObjectResourcesInterface::class, $objectResources);
    }

    public function testRegister()
    {
        $objectResources = $this->initializedObject();
        $objectResources->register('Var-3', new \ArrayIterator());
        $objectResources->register('Var-4', new \ArrayIterator());

        $that = $this;
        $assertPropertyClosure = function () use ($that) {
            $that->assertCount(4, $this->resources);
            foreach ($this->resources as $resource) {
                $that->assertIsObject($resource);
                $that->assertInstanceOf(\ArrayIterator::class, $resource);
            }
        };
        $doAssertPropertyClosure = $assertPropertyClosure->bindTo($objectResources, get_class($objectResources));
        // Assert running
        $doAssertPropertyClosure();

        $this->expectException(UnsupportedOperationException::class);
        $objectResources->register('Var-3', new \ArrayIterator());
    }

    public function testUpdate()
    {
        $objectResources = $this->initializedObject();
        $objectResources->update('Var-1', []);
        $objectResources->update('Var-2', []);

        $that = $this;
        $assertPropertyClosure = function () use ($that) {
            $that->assertCount(2, $this->resources);
            foreach ($this->resources as $resource) {
                $that->assertIsArray($resource);
            }
        };
        $doAssertPropertyClosure = $assertPropertyClosure->bindTo($objectResources, get_class($objectResources));
        // Assert running
        $doAssertPropertyClosure();

        $this->expectException(IllegalArgumentException::class);
        $objectResources->update('Var-1', null);
    }

    public function testRemove()
    {
        $objectResources = $this->initializedObject();
        $objectResources->remove('Var-1');

        $that = $this;
        $assertPropertyClosure = function () use ($that) {
            $that->assertCount(1, $this->resources);
        };
        $doAssertPropertyClosure = $assertPropertyClosure->bindTo($objectResources, get_class($objectResources));
        // Assert running
        $doAssertPropertyClosure();

        $this->expectException(NotFoundException::class);
        $objectResources->remove('Var-1', null);
    }

    public function testResource()
    {
        $objectResources = $this->initializedObject();

        $objectResources->register('Var-Z', new \ArrayIterator());
        self::assertNotNull($objectResources->resource('Var-Z'));
        self::assertIsObject($objectResources->resource('Var-Z'));
        self::assertInstanceOf(\ArrayIterator::class, $objectResources->resource('Var-Z'));

        $objectResources->update('Var-Z', []);
        self::assertNotNull($objectResources->resource('Var-Z'));
        self::assertIsArray($objectResources->resource('Var-Z'));
        self::assertCount(0, $objectResources->resource('Var-Z'));

        $objectResources->remove('Var-Z', []);
        $this->expectException(NotFoundException::class);
        $objectResources->resource('Var-Z');
    }

    /**
     * @return ObjectResources
     */
    private function initializedObject(): ObjectResources
    {
        $objectResources = new ObjectResources();
        $objectResources->register('Var-1', new \ArrayIterator());
        $objectResources->register('Var-2', new \ArrayIterator());
        return $objectResources;
    }

}
