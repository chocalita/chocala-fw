<?php

namespace Chocala\Configuration;

use Chocala\Base\Singleton;
use Chocala\Base\Singletonized;
use Chocala\System\Config\Configuration;
use Chocala\System\Config\Configurations;
use Chocala\System\Config\ConfigurationsInterface;
use Chocala\System\IO\File;

/**
 * Class Config
 * @package Chocala\Configuration
 *
 * Config Class (Singleton)
 * SINGLETON Pattern
 */
class Config implements ConfigurationsInterface, Singleton
{
    use Singletonized;

    /**
     * @var Configurations
     */
    private $configurations;

    private function __construct()
    {
        $this->configurations = new Configurations();
    }

    /**
     *
     * @param string $name
     * @return mixed
     */
    public static function _($name)
    {
        return self::instance()->configurations->value($name);
    }

    /**
     *
     * @param File $file
     * @return void
     */
    public function load(File $file)
    {
        $this->configurations->load($file);
    }

    /**
     * @return array
     */
    public function list(): array
    {
        return $this->configurations->list();
    }

    /**
     * @param $name
     * @return Configuration
     */
    public function config($name): Configuration
    {
        return $this->configurations->config($name);
    }

    /**
     * @param $name
     * @return string
     */
    public function value($name)
    {
        return $this->configurations->value($name);
    }


    public static function phpinfo()
    {
        ob_start();
        phpinfo();
        $phpinfo = ['phpinfo' => []];
        if (
            preg_match_all(
                '#(?:<h2>(?:<a name=".*?">)?(.*?)(?:</a>)?</h2>)|'
                . '(?:<tr(?: class=".*?")?><t[hd](?: class=".*?")?>'
                . '(.*?)\s*</t[hd]>(?:<t[hd](?: class=".*?")?>(.*?)\s*</t[hd]>'
                . '(?:<t[hd](?: class=".*?")?>(.*?)\s*</t[hd]>)?)?</tr>)#s',
                ob_get_clean(),
                $matches,
                PREG_SET_ORDER
            )
        ) {
            foreach ($matches as $match) {
                if (strlen($match[1])) {
                    $phpinfo[$match[1]] = [];
                } elseif (isset($match[3])) {
                    $phpinfo[end(array_keys($phpinfo))][$match[2]] = isset($match[4]) ?
                        array($match[3], $match[4]) : $match[3];
                } else {
                    $phpinfo[end(array_keys($phpinfo))][] = $match[2];
                }
            }
        }
        return $phpinfo;
    }
}
