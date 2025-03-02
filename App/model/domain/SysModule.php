<?php

use Base\SysModule as BaseSysModule;

/**
 *
 * @author: ypra
 */
class SysModule extends BaseSysModule
{
    use Validatable;

    static array $validationRules = [
        'Uri' => [
            'null' => false, 'blank'=> false,
            'size'=> ['min' => 3, 'max' => 30],
        ],
        'Name' => [
            'null' => false, 'blank'=> false,
            'size'=> ['min' => 3, 'max' => 50],
        ],
        'Access' => [
            'null' => false, 'blank'=> false
        ],
        'Description' => [
            'null' => true,  'blank'=> false,
        ],
        'IconClass' => [
            'null' => true,  'blank'=> true,
            'size'=> ['min' => 2, 'max' => 100],
        ],
    ];

    public function preSave() : bool
    {
        $this->description = trim($this->description)?: null;
        $this->icon_class = trim($this->icon_class)?: null;
        return parent::preSave();
    }

    public function preValidate() : bool
    {
        return $this->preSave();
    }

    /**
     * @return \Propel\Runtime\Collection\ObjectCollection|SysUri[]
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function uris()
    {
        return SysUriQuery::create()
                ->filterBySysModule($this)
                ->orderByPosition()
            ->find();
    }

}