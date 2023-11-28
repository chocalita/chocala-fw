<?php

namespace Chocala\I18N;

use Chocala\Base\NotFoundException;
use Chocala\Configuration\Config;
use Chocala\System\IO\File;

/**
 * Description of ChocalaI18N
 *
 * @author ypra
 */
class DefaultTranslation implements TranslationInterface
{

    const DEFAULT_LANG_FILE = 'default';

    const EXTENSION = ".php";

    /**
     *
     * @var DefaultTranslation|null
     */
    private static ?DefaultTranslation $mainInstance = null;

    /**
     * @var array|null
     */
    private ?array $defaultMessages = null;

    /**
     * @var array|null
     */
    private ?array $langMessages = null;

    /**
     *
     * @return DefaultTranslation
     */
    public static function mainInstance(): DefaultTranslation
    {
        if (self::$mainInstance == null) {
            self::$mainInstance = new self();
        }
        return self::$mainInstance;
    }

    /**
     * @return array
     * @throws NotFoundException
     */
    public function defaultMessages(): ?array
    {
        if ($this->defaultMessages === null) {
            $this->loadDefaultMessages();
        }
        return $this->defaultMessages;
    }

    public function __construct()
    {
        $this->loadLangMessages(Config::_('app.run.lang'));
    }

    /**
     *
     * @return void
     * @throws NotFoundException
     */
    private function loadDefaultMessages() : void
    {
        $langFile = new File(I18N_DIR . self::DEFAULT_LANG_FILE . self::EXTENSION);
        if ($langFile->exists()) {
            $this->defaultMessages = require($langFile->path());
            if (!is_array($this->defaultMessages)) {
                $this->defaultMessages = array();
            }
        } else {
            throw new NotFoundException(sprintf('Failed to open i18n \'%s\' file resource for ', 'default'));
        }
    }

    /**
     * @param string|null $lang
     * @return void
     */
    public function loadLangMessages(string $lang = null)
    {
        $langFile = new File(I18N_DIR . $lang . self::EXTENSION);
        if ($lang != '' && $langFile->exists()) {
            $this->langMessages = require($langFile->path());
            if (!is_array($this->langMessages)) {
                $this->langMessages = array();
            }
        } else {
            $this->loadDefaultMessages();
            $this->langMessages = $this->defaultMessages;
        }
    }

    /**
     *
     * @param string $message
     * @param array|null $args
     * @return string
     */
    private function proccessMessage(string $message, array $args = null): string
    {
        if (empty($args)) {
            return $message;
        } else {
            $keywords = array();
            foreach ($args as $k => $v) {
                $keywords['[{' . $k . '}]'] = $v;
            }
            return strtr($message, $keywords);
        }
    }

    /**
     * @param string $key
     * @param array $args
     * @return string
     * @throws NotFoundException
     */
    public function translate(string $key, array $args): string
    {
        if (isset($this->langMessages[$key])) {
            return $this->proccessMessage($this->langMessages[$key], $args);
        } else {
            $defaultMessages = $this->defaultMessages();
            if (isset($defaultMessages[$key])) {
                return $this->proccessMessage($defaultMessages[$key], $args);
            } else {
                return $key;
            }
        }
    }

}
