<?php

namespace Chocala\Configuration;

use Chocala\System\IO\File;

/**
 * Description of ConfigLoader
 *
 * @author ypra
 */
class ConfigLoader
{
    /** Config file */
    public const PARAMS_FILE = 'params.xml';

    private $configCoreFiles = ['chocala.properties', 'default.properties'];

    private $configAppFiles = ['app.properties', 'custom.properties'];

    /**
     * Single static instance from this class
     * @var ConfigLoader
     */
    private static $instance = null;

    /**
     * Returns a single instance from this class
     * @return ConfigLoader
     */
    public static function instance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __construct()
    {
        //TODO: use parameters with dynamic config files from framework and app
    }

    private function loadCoreConfigs()
    {
        foreach ($this->configCoreFiles as $configCoreFilename) {
            $configCoreFile = new File(BIN_DIR . $configCoreFilename);
            Config::instance()->load($configCoreFile);
        }
    }

    private function loadAppConfigs()
    {
        //TODO: agregar otros archivos de configuracion que sean de la app
        foreach ($this->configAppFiles as $configAppFilename) {
            $configAppFile = new File(CONFIGS_DIR . $configAppFilename);
            Config::instance()->load($configAppFile);
        }
    }

    private function loadParams()
    {
        $parametersFile = new File(BIN_DIR . self::PARAMS_FILE);
        Param::instance()->load($parametersFile);
    }

    /**
     * Load Parameters and Configs from config files
     */
    public function loadAll()
    {
        $this->loadCoreConfigs();
        $this->loadAppConfigs();
        $this->loadParams();
    }

    public static function loadConfigsOld()
    {
        self::instance()->loadAll();
    }


    private function getFileDir($configFile)
    {
        if (file_exists(realpath($configFile))) {
            return realpath($configFile);
        } elseif (file_exists(realpath(CONFIGS_DIR . $configFile))) {
            return realpath(CONFIGS_DIR . $configFile);
        } elseif (file_exists(realpath(BIN_DIR . $configFile))) {
            return realpath(BIN_DIR . $configFile);
        } else {
            throw new ChocalaException(
                ChocalaErrors::CONFIGURATION_FILE_NOT_FOUND . ': ' .
                $configFile
            );
        }
    }
}
