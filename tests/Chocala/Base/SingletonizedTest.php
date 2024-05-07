<?php

namespace Chocala\Base;

use Chocala\Base\Fakes\FakeSingletonized;
use PHPUnit\Framework\TestCase;

class SingletonizedTest extends TestCase
{
    private string $objectName;
    private $objectTime;

    public function setUp()
    {
        FakeSingletonized::instance();
        $this->objectName = FakeSingletonized::instance()->name;
        $this->objectTime = FakeSingletonized::instance()->time;
    }

    public function testInstance()
    {
        self::assertNotNull(FakeSingletonized::instance());
        self::assertIsObject(FakeSingletonized::instance());
        self::assertEquals($this->objectName, FakeSingletonized::instance()->name);
        self::assertEquals($this->objectTime, FakeSingletonized::instance()->time);
        self::assertNotEquals('FakeSingletonized-' . microtime(true), FakeSingletonized::instance()->name);
        self::assertNotEquals(microtime(), FakeSingletonized::instance()->time);
        $object = FakeSingletonized::instance();
        self::assertEquals($object, FakeSingletonized::instance());
        unset($object);
        self::assertEquals($this->objectName, FakeSingletonized::instance()->name);
        self::assertEquals($this->objectTime, FakeSingletonized::instance()->time);
    }
}
