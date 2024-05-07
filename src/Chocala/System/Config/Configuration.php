<?php

namespace Chocala\System\Config;

/**
 * Description of Configuration
 *
 * @author ypra
 */
class Configuration extends ConfigBase
{
    const ASSIGNATOR = '=';

    const COMMENTOR = '#';

    /**
     *
     * Config constructor.
     * @param string $name Configuration name
     * @param mixed $value Configuration value
     * @param string $description [optional] Description of the configuration
     */
    public function __construct($name, $value, $description = '')
    {
        parent::__construct($name, $value, self::PRIVATE_ACCESS, $description);
    }
}
