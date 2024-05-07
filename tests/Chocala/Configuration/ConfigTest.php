<?php

namespace Chocala\Configuration;

use Chocala\Base\NotFoundException;
use Chocala\System\Config\Configuration;
use Chocala\System\IO\File;
use Chocala\System\IO\IOException;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    /**
     * @var Config
     */
    private $configs;

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
        $this->configs = Config::instance();
        $this->file = new File(
            __DIR__ . DIRECTORY_SEPARATOR . 'resources' .
            DIRECTORY_SEPARATOR . 'test-configs.properties'
        );
        $this->noFile = new File(__DIR__ . 'xyz.properties');
        $this->configs->load($this->file);
    }

    public function test_()
    {
        $configs = $this->configs;

        $value = $configs::_('test.config.name');
        self::assertNotNull($value);
        self::assertIsString($value);
        self::assertEquals('test', $value);

        $value = $configs::_('test.object.name');
        self::assertNotNull($value);
        self::assertIsString($value);
        self::assertEquals('Name', $value);

        $value = $configs::_('test.object.value');
        self::assertNotNull($value);
        self::assertIsString($value);
        self::assertEquals('Value', $value);

        $notValue = $configs::_('not.config');
        self::assertNotNull($notValue);
        self::assertIsString($notValue);
        self::assertEquals('', $notValue);
    }

    public function testLoad()
    {
        $configs = $this->configs;
        $configs->load($this->file);
        self::assertNotEmpty($configs->list());
        $this->expectException(IOException::class);
        $configs->load($this->noFile);
    }

    public function testList()
    {
        $configs = $this->configs;
        self::assertNotNull($configs->list());
        self::assertNotEmpty($configs->list());
        self::assertIsArray($configs->list());
        self::assertCount(3, $configs->list());
        foreach ($configs->list() as $configuration) {
            self::assertIsObject($configuration);
            self::assertInstanceOf(Configuration::class, $configuration);
        }
    }

    public function testConfig()
    {
        $configs = $this->configs;

        $config = $configs->config('test.config.name');
        self::assertNotNull($config);
        self::assertIsObject($config);
        self::assertInstanceOf(Configuration::class, $config);
        self::assertEquals('test.config.name', $config->getName());

        $config = $configs->config('test.object.name');
        self::assertNotNull($config);
        self::assertIsObject($config);
        self::assertInstanceOf(Configuration::class, $config);
        self::assertEquals('test.object.name', $config->getName());

        $config = $configs->config('test.object.value');
        self::assertNotNull($config);
        self::assertIsObject($config);
        self::assertInstanceOf(Configuration::class, $config);
        self::assertEquals('test.object.value', $config->getName());

        $this->expectException(NotFoundException::class);
        $configs->config('not.config');
    }

    public function testValue()
    {
        $configs = $this->configs;

        $value = $configs->value('test.config.name');
        self::assertNotNull($value);
        self::assertIsString($value);
        self::assertEquals('test', $value);

        $value = $configs->value('test.object.name');
        self::assertNotNull($value);
        self::assertIsString($value);
        self::assertEquals('Name', $value);

        $value = $configs->value('test.object.value');
        self::assertNotNull($value);
        self::assertIsString($value);
        self::assertEquals('Value', $value);
    }

    public function testNotFoundValue()
    {
        $configs = $this->configs;
        $notValue = $configs->value('mot.config');
        self::assertNotNull($notValue);
        self::assertIsString($notValue);
        self::assertEquals('', $notValue);
    }
}
