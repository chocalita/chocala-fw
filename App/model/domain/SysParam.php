<?php

use Base\SysParam as BaseSysParam;

/**
 *
 * @author: ypra
 */
class SysParam extends BaseSysParam
{
    use Validatable;

    /** Param that applies for all (system param) */
    const VISIBILITY_GLOBAL = 'GLOBAL';

    /** Param available for each entity (entity param) */
    const VISIBILITY_ENTITY = 'ENTITY';

    /** Param available for each user (user param) */
    const VISIBILITY_USER = 'USER';

    /** Boolean Type */
    const TYPE_BOOLEAN = 'BOOLEAN';

    /** Date Type */
    const TYPE_DATE = 'DATE';

    /** Integer Type */
    const TYPE_INTEGER = 'INTEGER';

    /** String Type */
    const TYPE_LIST = 'LIST';

    /** Number Type */
    const TYPE_NUMBER = 'NUMBER';

    /** String Type */
    const TYPE_STRING = 'STRING';

    /**
     * @var array Status Map values
     */
    protected static $visibilityMap = [
        'default'   => [
            self::VISIBILITY_GLOBAL => self::VISIBILITY_GLOBAL,
            self::VISIBILITY_ENTITY => self::VISIBILITY_ENTITY,
            self::VISIBILITY_USER   => self::VISIBILITY_USER
        ],
        'es'        => [
            self::VISIBILITY_GLOBAL => 'GLOBAL',
            self::VISIBILITY_ENTITY => 'ENTIDAD',
            self::VISIBILITY_USER   => 'USUARIO'
        ],
    ];

    static $validationRules = [
        'Visibility' => [
            'null' => false, 'blank' => false,
            'inList' => [self::VISIBILITY_GLOBAL, self::VISIBILITY_ENTITY,
                self::VISIBILITY_USER],
        ],
        'Code' => [
            'null' => false, 'blank' => false, 'unique' => true,
        ],
        'Name' => [
            'null' => false, 'blank' => false, 'unique' => true,
        ],
        'Type' => [
            'null' => false, 'blank' => false,
            'inList' => [self::TYPE_BOOLEAN, self::TYPE_DATE,
                self::TYPE_INTEGER, self::TYPE_LIST, self::TYPE_NUMBER,
                self::TYPE_STRING]
        ],
        'Value' => [
            'null' => false, 'blank' => false,
            'size' => ['min' => 1, 'max' => 2000]
        ],
        'Options' => [
            'null' => true, 'blank' => false,
        ],
        'Description' => [
            'null' => false, 'blank' => false,
            'size' => ['min' => 5, 'max' => 2000]
        ],
        'Customizable' => [
            'null' => false,
        ],
    ];

    /**
     * @param string $lang |'default'|'es'
     * @return mixed
     */
    public static function visibilityMap($lang = 'default')
    {
        $type = array_key_exists(strtolower($lang), static::$visibilityMap)?
            strtolower($lang): 'default';
        return static::$visibilityMap[$type];
    }

    /**
     * @return array
     */
    public static function typeList()
    {
        return [self::TYPE_BOOLEAN, self::TYPE_DATE, self::TYPE_INTEGER,
            self::TYPE_LIST, self::TYPE_NUMBER, self::TYPE_STRING];
    }

    /**
     * @param string $value
     * @param string|null $type
     * @return bool|DateTime|float|string
     */
    public static function matchedValue($value, $type = null)
    {
        switch($type){
            case self::TYPE_BOOLEAN:
                return boolval($value);
            case self::TYPE_NUMBER:
                return $value*1;
            case self::TYPE_INTEGER:
                return round($value, 0, PHP_ROUND_HALF_UP);
            case self::TYPE_STRING:
                return ''.$value;
            case self::TYPE_DATE:
                return DateUtil::createFromFormat('d/M/y', $value);
            case self::TYPE_LIST:
                echo $value;
                return $value;
            default:
                return $value;
        }
    }

    public function preSave()
    {
        $this->code = trim($this->code)!=''? strtoupper(trim($this->code)): null;
        $this->name = trim($this->name)!=''? trim($this->name): null;
        $this->value = trim($this->value)!=''? trim($this->value): null;
        $this->options = trim($this->options)!=''? trim($this->options): null;
        $this->description = trim($this->description)!=''? trim($this->description): null;
        return parent::preSave();
    }

    public function preValidate()
    {
        return $this->preSave();
    }

    public function preInsert()
    {
        return $this->preSave();
    }

    public function preUpdate()
    {
        return $this->preSave();
    }

    /**
     * @return bool|DateTime|float|string
     */
    public function value()
    {
        return self::matchedValue($this->value, $this->type);
    }

    /**
     * @return array
     */
    public function options()
    {
        return explode(";", $this->getOptions());
    }

    /**
     * @param SysEntity $entity
     * @return SysEntityParam
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function entityParam(SysEntity $entity)
    {
        return SysEntityParamQuery::createForEntity($entity)->filterBySysParam($this)->findOne();
    }

    /**
     * @param SysUser $user
     * @return SysUserParam
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function userParam(SysUser $user)
    {
        return SysUserParamQuery::createForUser($user)->filterBySysParam($this)->findOne();
    }

}