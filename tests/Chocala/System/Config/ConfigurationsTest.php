<?php

namespace Chocala\System\Config;

use Chocala\Base\NotFoundException;
use Chocala\System\IO\File;
use Chocala\System\IO\IOException;
use PHPUnit\Framework\TestCase;

class ConfigurationsTest extends TestCase
{

    /**
     * @var Configurations
     */
    private $configurations;

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
        $this->configurations = new Configurations();
        $this->file = new File(__DIR__ . DIRECTORY_SEPARATOR . 'resources' .
            DIRECTORY_SEPARATOR . 'test-configs.properties');
        $this->noFile = new File(__DIR__ . 'xyz.properties');
        $this->configurations->load($this->file);
    }

    public function test__construct()
    {
        $configurations = new Configurations();
        self::assertNotNull($configurations);
        self::assertIsObject($configurations);
        self::assertObjectHasAttribute('list', $configurations);
    }

    public function testLoad()
    {
        $configurations = new Configurations();
        $configurations->load($this->file);
        self::assertNotEmpty($configurations->list());
        $this->expectException(IOException::class);
        $configurations->load($this->noFile);
    }

    public function testList()
    {
        $configurations = $this->configurations;
        self::assertNotNull($configurations->list());
        self::assertNotEmpty($configurations->list());
        self::assertIsArray($configurations->list());
        self::assertCount(7, $configurations->list());
        foreach ($configurations->list() as $configuration) {
            self::assertIsObject($configuration);
            self::assertInstanceOf(Configuration::class, $configuration);
        }

        $configurations = new Configurations();
        self::assertEmpty($configurations->list());
    }

    public function testConfig()
    {
        $configurations = $this->configurations;

        $configuration = $configurations->config('test.config.name');
        self::assertNotNull($configuration);
        self::assertIsObject($configuration);
        self::assertInstanceOf(Configuration::class, $configuration);
        self::assertEquals('test.config.name', $configuration->getName());

        $configuration = $configurations->config('app.name');
        self::assertNotNull($configuration);
        self::assertIsObject($configuration);
        self::assertInstanceOf(Configuration::class, $configuration);
        self::assertEquals('app.name', $configuration->getName());

        $configuration = $configurations->config('app.version');
        self::assertNotNull($configuration);
        self::assertIsObject($configuration);
        self::assertInstanceOf(Configuration::class, $configuration);
        self::assertEquals('app.version', $configuration->getName());

        $configuration = $configurations->config('test.object.name');
        self::assertNotNull($configuration);
        self::assertIsObject($configuration);
        self::assertInstanceOf(Configuration::class, $configuration);
        self::assertEquals('test.object.name', $configuration->getName());

        $configurations = new Configurations();
        $this->expectException(NotFoundException::class);
        $configurations->config('not.config');

    }

    public function testNotFoundParameter()
    {
        $configurations = $this->configurations;
        $this->expectException(NotFoundException::class);
        $configurations->config('ABC0123_PARAM');
    }

    public function testValue()
    {
        $configurations = $this->configurations;

        $value = $configurations->value('test.config.name');
        self::assertNotNull($value);
        self::assertIsString($value);
        self::assertEquals('test', $value);

        $value = $configurations->value('app.name');
        self::assertNotNull($value);
        self::assertIsString($value);
        self::assertEquals('Chocala Framework', $value);

        $value = $configurations->value('app.version');
        self::assertNotNull($value);
        self::assertIsString($value);
        self::assertEquals('3.0', $value);

        $value = $configurations->value('test.object.name');
        self::assertNotNull($value);
        self::assertIsString($value);
        self::assertEquals('Name', $value);

        $configurations = new Configurations();
        self::assertNotNull($value);
        self::assertIsString($value);
        self::assertEquals('', $configurations->value('not.config'));
    }

    public function testNotFoundValue()
    {
        $configurations = $this->configurations;
        $notValue = $configurations->value('ABC0123_PARAM');
        self::assertNotNull($notValue);
        self::assertIsString($notValue);
        self::assertEquals('', $notValue);
    }

}
