<?php

use Base\SysRol as BaseSysRol;

/**
 *
 *
 */
class SysRol extends BaseSysRol
{
    use Validatable;

    static array $validationRules = [
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

    public function preSave() : bool
    {
        $this->code = trim(strtoupper($this->code))?: null;
        $this->name = trim($this->name)?: null;
        $this->description = trim($this->description)?: null;
        return parent::preSave();
    }

    public function preValidate() : bool
    {
        return $this->preSave();
    }

    /**
     * @param bool|true $noDeletes
     * @return \Propel\Runtime\Collection\ObjectCollection|SysRolXUri[]
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function rolUris(bool $noDeletes=true)
    {
        return SysRolXUriQuery::findByRol($this, $noDeletes);
    }

}