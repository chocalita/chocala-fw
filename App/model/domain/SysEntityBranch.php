<?php

use Base\SysEntityBranch as BaseSysEntityBranch;

/**
 *
 */
class SysEntityBranch extends BaseSysEntityBranch implements JsonSerializable
{
    use Validatable, Convertible;

    protected $entity_id = 0;


    static $validationRules = [
        'EntityId' => [
            'null' => false, 'blank' => false,
        ],
        'LocationId' => [
            'null' => false, 'blank' => false,
        ],
        'Name' => [
            'null' => false, 'blank' => false,
            'size' => ['min' => 2, 'max' => 300],
        ],
        'Address' => [
            'null' => false, 'blank'=> false,
            'size' => ['min' => 3, 'max' => 500],
        ],
        'Phone' => [
            'null' => false, 'blank' => false,
            'size' => ['min' => 3, 'max' => 30],
        ],
        'Cellphone' => [
            'null' => false, 'blank' => false,
            'size' => ['min' => 3, 'max' => 30],
        ],
        'Fax' => [
            'null' => true, 'blank' => false,
            'size' => ['min' => 3, 'max' => 30],
        ],
        'Description' => [
            'null' => true, 'blank'=> false,
            'size' => ['min' => 3, 'max' => 500],
        ],
    ];

    public function preSave()
    {
        $this->entity_id = $this->entity_id?: null;
        $this->location_id = $this->location_id?: null;
        $this->name = strtoupper(trim($this->name))?: null;
        $this->address = trim($this->address)?: null;
        $this->phone = trim($this->phone)?: null;
        $this->cellphone = trim($this->cellphone)?: null;
        $this->fax = trim($this->fax)?: null;
        $this->description = trim($this->description)?: null;
        return parent::preSave();
    }

    public function preValidate()
    {
        return $this->preSave();
    }

}
