<?php

namespace Chocala\Base;

use App\configs\AppConfig;

/**
 * Description of ChocalaAlias
 *
 * @author ypra
 */
class ChocalaAlias
{

    /**
     *
     * @param string $key
     * @return boolean
     */
    public static function isAlias(string $key): bool
    {
        return isset(AppConfig::$aliases[$key]);
    }

    /**
     *
     * @param string $key
     * @return string
     */
    public static function aliasDir(string $key): ?string
    {
        return self::isAlias($key)? AppConfig::$aliases[$key]: null;
    }

}