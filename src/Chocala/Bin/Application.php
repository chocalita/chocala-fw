<?php

namespace Chocala\Bin;

use Chocala\Base\GlobalObjectResources;
use Chocala\Base\Singleton;
use Chocala\Base\Singletonized;
use Chocala\Behavior\Logger;
use Chocala\I18N\DefaultTranslation;
use Chocala\I18N\TranslationInterface;
use Psr\Log\LoggerInterface;

class Application
{

    public const LOGGER = 'LOGGER';

    private $configLoader;

    /**
     * @var TranslationInterface
     */
    private $translation;

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger();
        GlobalObjectResources::instance()->register(self::LOGGER, $this->logger);
        $this->configLoader = new ConfigLoader();
        $this->translation = DefaultTranslation::mainInstance();
    }


    public function run()
    {
        $this->configLoader->loadConfigs();
    }

}
