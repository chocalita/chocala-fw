<?php

namespace Chocala\Configuration;

use Chocala\Base\NotFoundException;
use Chocala\System\Config\Parameter;
use Chocala\System\IO\File;
use Chocala\System\IO\IOException;
use PHPUnit\Framework\TestCase;

class ParamTest extends TestCase
{
    /**
     * @var Param
     */
    private $params;

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
        $this->params = Param::instance();
        $this->file = new File(
            __DIR__ . DIRECTORY_SEPARATOR . 'resources' .
            DIRECTORY_SEPARATOR . 'test-params.xml'
        );
        $this->noFile = new File(__DIR__ . 'xyz.xml');
        $this->params->load($this->file);
    }


    public function test_()
    {
        $params = $this->params;

        $value = $params::_('INTEGER_PARAM');
        self::assertNotNull($value);
        self::assertIsString($value);
        self::assertEquals('5', $value);

        $value = $params::_('STRING_PARAM');
        self::assertNotNull($value);
        self::assertIsString($value);
        self::assertEquals('text', $value);

        $notValue = $params::_('ABC0123_PARAM');
        self::assertNotNull($notValue);
        self::assertIsString($notValue);
        self::assertEquals('', $notValue);
    }

    public function testLoad()
    {
        $params = $this->params;
        $params->load($this->file);
        self::assertNotEmpty($params->list());
        $this->expectException(IOException::class);
        $params->load($this->noFile);
    }

    public function testList()
    {
        $params = $this->params;
        self::assertNotNull($params->list());
        self::assertNotEmpty($params->list());
        self::assertIsArray($params->list());
        self::assertCount(2, $params->list());
        foreach ($params->list() as $parameter) {
            self::assertIsObject($parameter);
            self::assertInstanceOf(Parameter::class, $parameter);
        }
    }

    public function testParam()
    {
        $params = $this->params;

        $parameter = $params->param('INTEGER_PARAM');
        self::assertNotNull($parameter);
        self::assertIsObject($parameter);
        self::assertInstanceOf(Parameter::class, $parameter);
        self::assertEquals('INTEGER', $parameter->getType());

        $parameter = $params->param('STRING_PARAM');
        self::assertNotNull($parameter);
        self::assertIsObject($parameter);
        self::assertInstanceOf(Parameter::class, $parameter);
        self::assertEquals('STRING', $parameter->getType());
    }

    public function testNotFoundParameter()
    {
        $params = $this->params;
        $this->expectException(NotFoundException::class);
        $params->param('ABC0123_PARAM');
    }

    public function testValue()
    {
        $params = $this->params;

        $value = $params->value('INTEGER_PARAM');
        self::assertNotNull($value);
        self::assertIsString($value);
        self::assertEquals('5', $value);

        $value = $params->value('STRING_PARAM');
        self::assertNotNull($value);
        self::assertIsString($value);
        self::assertEquals('text', $value);
    }

    public function testNotFoundValue()
    {
        $params = $this->params;
        $notValue = $params->value('ABC0123_PARAM');
        self::assertNotNull($notValue);
        self::assertIsString($notValue);
        self::assertEquals('', $notValue);
    }
}
