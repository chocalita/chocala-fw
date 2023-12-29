<?php

namespace Chocala\Web\Result;

use PHPUnit\Framework\TestCase;

class ActionDataTest extends TestCase
{

    private array $values = [
        'key' => 'value',
        'foo' => 'bar',
        'num' => 10
    ];

    public function test__construct()
    {
        $object = new ActionData();
        self::assertNotNull($object);
        self::assertIsObject($object);
    }

    public function testVars()
    {
        $object = new ActionData();
        $this->objectBasics($object);
    }

    public function testSetVar()
    {
        $object = new ActionData();
        $this->objectBasics($object);
        $object->setVar('key', 'value');
        $object->setVar('numeric', 1);
        self::assertNotEmpty($object->vars());
        self::assertCount(2, $object->vars());
    }

    public function testSetVars()
    {
        $object = new ActionData();
        $this->objectBasics($object);
        $object->setVar('numeric', 1);
        self::assertCount(1, $object->vars());
        $object->setVars($this->values);
        self::assertNotEmpty($object->vars());
        self::assertCount(3, $object->vars());
        self::assertSameSize($this->values, $object->vars());
        self::assertEquals($this->values, $object->vars());
    }

    public function test__toString()
    {
        $object = new ActionData();
        $this->objectBasics($object);
        self::assertEmpty($object->__toString());
        self::assertSame('', $object->__toString());
        $object->setVars($this->values);
        self::assertNotEmpty($object->__toString());
        self::assertNotEquals('[]', $object->__toString());
        self::assertStringStartsWith('{', $object->__toString());
        self::assertStringEndsWith('}', $object->__toString());
    }

    private function objectBasics(ActionData $object)
    {
        self::assertNotNull($object);
        self::assertIsObject($object);
        self::assertNotNull($object->vars());
        self::assertIsArray($object->vars());
    }

}