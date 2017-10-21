<?php

use Base\SysRol as BaseSysRol;

/**
 *
 *
 */
class SysRol extends BaseSysRol
{
    use Validatable;

    static $validationRules = [
        'Code' => [
            'null' => false, 'blank'=> false,
            'size'=> ['min' => 3, 'max' => 30],
        ],
        'Name' => [
            'null' => false, 'blank'=> false,
            'size'=> ['min' => 3, 'max' => 50],
        ],
        'Description' => [
            'null' => true,  'blank'=> false,
            'unique' => true
        ],
    ];

    public function preSave()
    {
        $this->code = trim(strtoupper($this->code))?: null;
        $this->name = trim($this->name)?: null;
        $this->description = trim($this->description)?: null;
        return parent::preSave();
    }

    public function preValidate()
    {
        return $this->preSave();
    }

    /**
     * @param bool|true $noDeletes
     * @return \Propel\Runtime\Collection\ObjectCollection|SysRolXUri[]
     */
    public function rolUris($noDeletes=true)
    {
        return SysRolXUriQuery::findByRol($this, $noDeletes);
    }

}