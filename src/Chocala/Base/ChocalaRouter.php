<?php

namespace Chocala\Base;

/**
 * Description of ChocalaRouter
 *
 * @author ypra
 */
class ChocalaRouter
{

    /**
     *
     * @param string $key
     * @return boolean
     */
    public static function isRouting($key)
    {
        // TODO: use for url mapping with URI::instance()
        return isset(URIMapping::$map[$key]);
    }

    /**
     *
     * @param string $key
     * @return string
     */
    public static function routeURL($key)
    {
        // TODO: use for url mapping with URI::instance()
        return self::isAlias($key)? AppConfig::$aliases[$key]: null;
    }

}