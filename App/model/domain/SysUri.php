<?php

use Base\SysUri as BaseSysUri;

/**
 *
 * @author: ypra
 */
class SysUri extends BaseSysUri
{
    use Validatable;

    static array $validationRules = [
        'ModuleId' => [
            'null' => false, 'blank'=> false,
        ],
        'Uri' => [
            'null' => false, 'blank'=> false,
            'size'=> ['min' => 3, 'max' => 30],
        ],
        'Title' => [
            'null' => false, 'blank'=> false,
            'size'=> ['min' => 3, 'max' => 50],
        ],
        'Access' => [
            'null' => false, 'blank'=> false
        ],
        'Type' => [
            'null' => false, 'blank'=> false
        ],
        'Description' => [
            'null' => true,  'blank'=> false,
            'size' => ['min' => 5, 'max' => 2000]
        ],
        'Icon' => [
            'null' => true,  'blank'=> true,
            'size'=> ['min' => 2, 'max' => 100],
        ],
        'Mark' => [
            'null' => true,  'blank'=> true,
            'size'=> ['min' => 5, 'max' => 200],
        ],
    ];

    public function preSave(): bool
    {
        $this->uri = trim($this->uri)?: null;
        $this->title = trim($this->title)?: null;
        $this->description = trim($this->description)?: null;
        $this->icon = trim($this->icon)?: null;
        $this->mark = trim($this->mark)?: null;
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
        return SysRolXUriQuery::findByUri($this, $noDeletes);
    }

}