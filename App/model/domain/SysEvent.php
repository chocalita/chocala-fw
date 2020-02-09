<?php

use Base\SysEvent as BaseSysEvent;

/**
 *
 * @author: ypra
 */
class SysEvent extends BaseSysEvent implements JsonSerializable
{
    use Validatable, Convertible;


    const TYPE_SYSTEM = 'SYSTEM';
    const TYPE_SECURITY = 'SECURITY';
    const TYPE_APP = 'APP';
    const TYPE_AUDIT_PROCESS = 'AUDIT_PROCESS';

    const LEVEL_SYSTEM = 'SYSTEM';
    const LEVEL_ADMIN = 'ADMIN';
    const LEVEL_APP = 'APP';

    static $types = [
        self::TYPE_SYSTEM => self::TYPE_SYSTEM,
        self::TYPE_SECURITY => self::TYPE_SECURITY,
        self::TYPE_APP => self::TYPE_APP,
        self::TYPE_AUDIT_PROCESS => self::TYPE_AUDIT_PROCESS,
    ];

    static $levels = [
        self::LEVEL_SYSTEM => self::LEVEL_SYSTEM,
        self::LEVEL_ADMIN => self::LEVEL_ADMIN,
        self::LEVEL_APP => self::LEVEL_APP,
    ];

    static $validationRules = [
        'Code' => [
            'null' => false, 'blank'=> false,
            'size'=> ['min' => 3, 'max' => 30],
        ],
        'Name' => [
            'null' => false, 'blank'=> false,
            'size'=> ['min' => 3, 'max' => 100],
        ],
        'Type' => [
            'null' => false, 'blank'=> false,
            'size' => ['min' => 3, 'max' => 30],
        ],
        'Level' => [
            'null' => false, 'blank'=> false,
            'size' => ['min' => 2, 'max' => 30],
        ],
        'Description' => [
            'null' => true, 'blank'=> false,
        ],
    ];

    public function preSave()
    {
        $this->code = trim($this->code)!=''? strtoupper(trim($this->code)): null;
        $this->name = trim($this->name)!=''? trim($this->name): null;
        $this->type = trim($this->type)!=''? trim($this->type): null;
        $this->level = trim($this->level)!=''? trim($this->level): null;
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


}
