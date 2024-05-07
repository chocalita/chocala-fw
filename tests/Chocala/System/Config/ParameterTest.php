<?php

namespace Chocala\System\Config;

use Chocala\Base\IllegalArgumentException;
use PHPUnit\Framework\TestCase;

class ParameterTest extends TestCase
{
    private $name = 'param0';
    private $value = 'TestValue';
    private $description = 'Test Description';

    /**
     * @covers Chocala\Base\Parameter
     */
    public function testConstructor()
    {
        $parameter = $this->basicObject();
        $this->assertEquals($this->name, $parameter->getName());
        $this->assertEquals($this->value, $parameter->getValue());
        $this->assertEquals(Parameter::TYPE_STRING, $parameter->getType());
        $this->assertEquals(Parameter::PROTECTED_ACCESS, $parameter->getAccess());
        $this->assertEquals($this->description, $parameter->getDescription());
        $this->assertSameSize([], $parameter->getOptions());
    }

    /**
     * @covers Chocala\System\Config\Parameter
     */
    public function testOtherConstructors()
    {
        $parameter = new Parameter('paramParent', 'TestValueParent', Parameter::TYPE_STRING);
        $this->assertEquals('paramParent', $parameter->getName());
        $this->assertEquals('TestValueParent', $parameter->getValue());
        $this->assertEquals(Parameter::TYPE_STRING, $parameter->getType());
        $this->assertEquals(Parameter::PROTECTED_ACCESS, $parameter->getAccess());
        $this->assertNotNull($parameter->getOptions());
        $this->assertCount(0, $parameter->getOptions());
    }

    /**
     * @covers Chocala\System\Config\Parameter
     */
    public function testAccesors()
    {
        $name = 'name' . time();
        $value = 'value' . time();
        $type = Parameter::TYPE_LIST;
        $description = 'Test Description ' . time();
        $access = Parameter::PUBLIC_ACCESS;
        $options = [1, 1, 2, 3, 5, 8];

        $parameter = $this->basicObject();
        $parameter->setName($name);
        $parameter->setValue($value);
        $parameter->setType($type);
        $parameter->setDescription($description);
        $parameter->setAccess($access);
        $parameter->setOptions($options);

        $this->assertEquals($name, $parameter->getName());
        $this->assertEquals($value, $parameter->getValue());
        $this->assertEquals($type, $parameter->getType());
        $this->assertEquals($description, $parameter->getDescription());
        $this->assertEquals($access, $parameter->getAccess());
        $this->assertNotEmpty($parameter->getOptions());
        $this->assertCount(6, $parameter->getOptions());
    }

    /**
     * @covers Chocala\System\Config\Parameter
     */
    public function testInvalidType()
    {
        $parameter = $this->basicObject();
        $this->expectException(IllegalArgumentException::class);
        $parameter->setType(1);
    }

    /**
     * @covers Chocala\System\Config\Parameter
     */
    public function testInvalidOptions()
    {
        $parameter = $this->basicObject();
        $this->expectException(IllegalArgumentException::class);
        $parameter->setOptions(null);
    }

    /**
     * @return Parameter
     */
    private function basicObject()
    {
        return new Parameter(
            $this->name,
            $this->value,
            Parameter::TYPE_STRING,
            Parameter::PROTECTED_ACCESS,
            $this->description,
            []
        );
    }
}
