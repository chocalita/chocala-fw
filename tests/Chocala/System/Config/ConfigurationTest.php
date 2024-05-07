<?php

namespace Chocala\System\Config;

use PHPUnit\Framework\TestCase;

class ConfigurationTest extends TestCase
{
    private $name = 'config0';
    private $value = 'TestValue';
    private $description = 'Test Description';


    /**
     * @covers Chocala\Base\Configuration
     */
    public function testConstructor()
    {
        $config = $this->basicObject();
        $this->assertEquals($this->name, $config->getName());
        $this->assertEquals($this->value, $config->getValue());
        $this->assertEquals($this->description, $config->getDescription());
        $this->assertEquals(Configuration::PRIVATE_ACCESS, $config->getAccess());
    }

    /**
     * @covers Chocala\Base\Configuration
     */
    public function testOtherConstructors()
    {
        $param = new Configuration('paramParent', 'TestValueParent', 'Test Description');
        $this->assertEquals('paramParent', $param->getName());
        $this->assertEquals('TestValueParent', $param->getValue());
        $this->assertEquals('Test Description', $param->getDescription());
        $this->assertEquals(Parameter::PRIVATE_ACCESS, $param->getAccess());
    }

    /**
     * @covers Chocala\Base\Configuration
     */
    public function testAccesors()
    {
        $name = 'name' . time();
        $value = 'value' . time();
        $description = 'Test Description ' . time();
        $access = Parameter::PUBLIC_ACCESS;

        $config = $this->basicObject();
        $config->setName($name);
        $config->setValue($value);
        $config->setDescription($description);
        $config->setAccess($access);

        $this->assertEquals($name, $config->getName());
        $this->assertEquals($value, $config->getValue());
        $this->assertEquals($description, $config->getDescription());
        $this->assertEquals($access, $config->getAccess());
    }


    /**
     * @return Configuration
     */
    private function basicObject()
    {
        return new Configuration($this->name, $this->value, $this->description);
    }
}
