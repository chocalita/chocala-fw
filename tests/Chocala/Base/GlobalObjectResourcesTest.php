<?php

namespace Chocala\Base;

use PHPUnit\Framework\TestCase;

class GlobalObjectResourcesTest extends TestCase
{
    public function testSingleton()
    {
        $className = GlobalObjectResources::class;
        $this->expectException(\Error::class);
        new $className();
    }

    public function testRegister()
    {
        GlobalObjectResources::instance()->register('Var-1', []);
        self::assertNotNull(GlobalObjectResources::instance()->resource('Var-1'));
        self::assertIsArray(GlobalObjectResources::instance()->resource('Var-1'));
    }

    public function testUpdate()
    {
        GlobalObjectResources::instance()->register('Var-9', new \ArrayIterator());
        GlobalObjectResources::instance()->update('Var-9', new \ArrayIterator());
        self::assertNotNull(GlobalObjectResources::instance()->resource('Var-9'));
        self::assertIsObject(GlobalObjectResources::instance()->resource('Var-9'));
    }

    public function testRemove()
    {
        GlobalObjectResources::instance()->register('Var-20', []);
        GlobalObjectResources::instance()->remove('Var-20');
        $this->expectException(NotFoundException::class);
        GlobalObjectResources::instance()->resource('Var-20');
    }

    public function testResource()
    {
        GlobalObjectResources::instance()->register('Var-X', [1, 2, 3, 4, 5]);
        GlobalObjectResources::instance()->register('Var-Y', new \ArrayIterator());
        GlobalObjectResources::instance()->register('Var-Z', new \DateTime());

        self::assertNotNull(GlobalObjectResources::instance()->resource('Var-X'));
        self::assertIsArray(GlobalObjectResources::instance()->resource('Var-X'));
        self::assertCount(5, GlobalObjectResources::instance()->resource('Var-X'));

        self::assertNotNull(GlobalObjectResources::instance()->resource('Var-Y'));
        self::assertIsObject(GlobalObjectResources::instance()->resource('Var-Y'));
        self::assertInstanceOf(\ArrayIterator::class, GlobalObjectResources::instance()->resource('Var-Y'));

        self::assertNotNull(GlobalObjectResources::instance()->resource('Var-Z'));
        self::assertIsObject(GlobalObjectResources::instance()->resource('Var-Z'));
        self::assertInstanceOf(\DateTime::class, GlobalObjectResources::instance()->resource('Var-Z'));
    }
}
