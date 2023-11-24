<?php

namespace Chocala\System\Config;

use Chocala\Base\IllegalStateException;
use Chocala\Base\NotFoundException;
use Chocala\System\IO\File;
use Chocala\System\IO\IOException;
use PHPUnit\Framework\TestCase;

class ParametersTest extends TestCase
{

    /**
     * @var Parameters
     */
    private $parameters;

    /**
     * @var File
     */
    private $file;

    /**
     * @var File
     */
    private $noFile;

    public function setUp()
    {
        $this->parameters = new Parameters();
        $this->file = new File(__DIR__ . DIRECTORY_SEPARATOR . 'resources' .
            DIRECTORY_SEPARATOR . 'test-params.xml');
        $this->noFile = new File(__DIR__ . 'xyz.xml');
        $this->parameters->load($this->file);
    }

    public function test__construct()
    {
        $parameters = new Parameters();
        self::assertNotNull($parameters);
        self::assertIsObject($parameters);
        self::assertObjectHasAttribute('xmlObject', $parameters);
        self::assertObjectHasAttribute('list', $parameters);
    }

    public function testLoad()
    {
        $parameters = new Parameters();
        $parameters->load($this->file);
        self::assertNotEmpty($parameters->list());
        $this->expectException(IOException::class);
        $parameters->load($this->noFile);
    }

    public function testList()
    {
        $parameters = $this->parameters;
        self::assertNotNull($parameters->list());
        self::assertNotEmpty($parameters->list());
        self::assertIsArray($parameters->list());
        self::assertCount(4, $parameters->list());
        foreach ($parameters->list() as $parameter) {
            self::assertIsObject($parameter);
            self::assertInstanceOf(Parameter::class, $parameter);
        }

        $parameters = new Parameters();
        $this->expectException(IllegalStateException::class);
        $parameters->list();
    }

    public function testParam()
    {
        $parameters = $this->parameters;

        $parameter = $parameters->param('SWITCH_PARAM');
        self::assertNotNull($parameter);
        self::assertIsObject($parameter);
        self::assertInstanceOf(Parameter::class, $parameter);
        self::assertEquals('SWITCH', $parameter->getType());

        $parameter = $parameters->param('INTEGER_PARAM');
        self::assertNotNull($parameter);
        self::assertIsObject($parameter);
        self::assertInstanceOf(Parameter::class, $parameter);
        self::assertEquals('INTEGER', $parameter->getType());

        $parameter = $parameters->param('NUMBER_PARAM');
        self::assertNotNull($parameter);
        self::assertIsObject($parameter);
        self::assertInstanceOf(Parameter::class, $parameter);
        self::assertEquals('NUMBER', $parameter->getType());

        $parameter = $parameters->param('STRING_PARAM');
        self::assertNotNull($parameter);
        self::assertIsObject($parameter);
        self::assertInstanceOf(Parameter::class, $parameter);
        self::assertEquals('STRING', $parameter->getType());

        $parameters = new Parameters();
        $this->expectException(IllegalStateException::class);
        $parameters->param('ANY_PARAM');
    }

    public function testNotFoundParameter()
    {
        $parameters = $this->parameters;
        $this->expectException(NotFoundException::class);
        $parameters->param('ABC0123_PARAM');
    }

    public function testValue()
    {
        $parameters = $this->parameters;

        $value = $parameters->value('SWITCH_PARAM');
        self::assertNotNull($value);
        self::assertIsString($value);
        self::assertEquals('true', $value);

        $value = $parameters->value('INTEGER_PARAM');
        self::assertNotNull($value);
        self::assertIsString($value);
        self::assertEquals('5', $value);

        $value = $parameters->value('NUMBER_PARAM');
        self::assertNotNull($value);
        self::assertIsString($value);
        self::assertEquals('99.99', $value);

        $value = $parameters->value('STRING_PARAM');
        self::assertNotNull($value);
        self::assertIsString($value);
        self::assertEquals('text', $value);

        $parameters = new Parameters();
        $this->expectException(IllegalStateException::class);
        $parameters->value('ANY_PARAM');
    }

    public function testNotFoundValue()
    {
        $parameters = $this->parameters;
        $notValue = $parameters->value('ABC0123_PARAM');
        self::assertNotNull($notValue);
        self::assertIsString($notValue);
        self::assertEquals('', $notValue);
    }

}
