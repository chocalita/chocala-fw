<?php

namespace Chocala\System\Config;

use Chocala\Base\IllegalArgumentException;

/**
 * Description of Parameter
 *
 * @author ypra
 */
class Parameter extends ConfigBase
{

    /** Integer values accepted */
    const TYPE_INTEGER = 'INTEGER';

    /** List of values accepted (Only by options)*/
    const TYPE_LIST = 'LIST';

    /** Number values accepted */
    const TYPE_NUMBER = 'NUMBER';

    /** Sequential list of values accepted (Only by options)*/
    const TYPE_SEQUENTIAL = 'SEQUENTIAL';

    /** String values accepted */
    const TYPE_STRING = 'STRING';

    /** Values 0/1 (On/Off) only accepted */
    const TYPE_SWITCH = 'SWITCH';

    /**
     *
     * @var string
     */
    protected $type = null;

    /**
     *
     * @var array
     */
    protected $options = [];

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param $type
     * @return void
     * @throws ChocalaException
     */
    public function setType(string $type)
    {
        if (!in_array($type, self::enumTypes())) {
            throw new IllegalArgumentException(sprintf('Value \'%s\' is not a valid [type].', $type));
        }
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param string $options
     * @return void
     */
    public function setOptions($options)
    {
        if (!is_array($options)) {
            throw new IllegalArgumentException(sprintf('Invalid [options] value.'));
        }
        $this->options = $options;
    }

    /**
     *
     * @param string $name Configuration name
     * @param mixed $value Configuration value
     * @param string $type Type of data of configuration
     * @param string $access [optional] Visibility of the configuration
     * @param string $description [optional] Description of the configuration
     * @param array $options [optional] List of options by configuration
     */
    public function __construct($name, $value, $type,
                                $access = self::PROTECTED_ACCESS, $description = '',
                                $options = [])
    {
        parent::__construct($name, $value, $access, $description);
        $this->setType($type);
        $this->setOptions($options);
    }

    /**
     * Return a enum whit all the data types of configurations
     * @return array
     */
    public static function enumTypes()
    {
        return [
            self::TYPE_INTEGER => self::TYPE_INTEGER,
            self::TYPE_LIST => self::TYPE_LIST,
            self::TYPE_NUMBER => self::TYPE_NUMBER,
            self::TYPE_SEQUENTIAL => self::TYPE_SEQUENTIAL,
            self::TYPE_STRING => self::TYPE_STRING,
            self::TYPE_SWITCH => self::TYPE_SWITCH
        ];
    }

}