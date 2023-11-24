<?php

namespace Chocala\Configuration;

use PHPUnit\Framework\TestCase;

class ConfigLoaderTest extends TestCase
{

    private $configLoader;

    protected function setUp()
    {
        $this->configLoader = new ConfigLoader();
        if (!defined('BIN_DIR')) {
            define('BIN_DIR', __DIR__ . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR);
        }
    }

    public function test__construct()
    {
        $configLoader = new ConfigLoader();
        self::assertNotNull($configLoader);
        self::assertIsObject($configLoader);
    }

    public function testLoadConfigs()
    {
//        $this->configLoader->loadAll();
        self::assertNull(null);
    }

}
