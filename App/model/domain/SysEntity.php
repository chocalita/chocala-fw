<?php

use Base\SysEntity as BaseSysEntity;

/**
 *
 * @author: ypra
 */
class SysEntity extends BaseSysEntity implements JsonSerializable
{
    use Validatable, Convertible;

    protected $main_branch_id = 0;

    static array $validationRules = [
        'EntityTypeId' => [
            'null' => false, 'blank' => false,
        ],
        'LocationId' => [
            'null' => false, 'blank' => false,
        ],
        'MainBranchId' => [
            'null' => true, 'blank' => false,
        ],
        'Code' => [
            'null' => false, 'blank' => false, 'unique' => true,
            'size' => ['min' => 3, 'max' => 20],
        ],
        'ComercialName' => [
            'null' => false, 'blank' => false,
            'size' => ['min' => 2, 'max' => 300],
        ],
        'FormalName' => [
            'null' => false, 'blank' => false,
            'size' => ['min' => 2, 'max' => 300],
        ],
        'Nit' => [
            'null' => true, 'blank' => false, 'unique' => true,
            'size' => ['min' => 3, 'max' => 20],
        ],
        'Email' => [
            'null' => false, 'blank' => false,
            'email'=> false, 'unique' => true,
            'size' => ['min' => 3, 'max' => 100],
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
        'Activities' => [
            'null' => false, 'blank' => false,
            'size' => ['min' => 5, 'max' => 500],
        ],
        'Description' => [
            'null' => true, 'blank'=> false,
            'size' => ['min' => 5, 'max' => 500],
        ],
    ];

    public function preSave() : bool
    {
        $this->entity_type_id = $this->entity_type_id?: null;
        $this->location_id = $this->location_id?: null;
        $this->code = trim($this->code)?: null;
        $this->comercial_name = trim($this->comercial_name)?: null;
        $this->formal_name = strtoupper(trim($this->formal_name))?: null;
        $this->nit = trim($this->nit)?: null;
        $this->email = strtolower(trim($this->email))?: null;
        $this->address = trim($this->address)?: null;
        $this->phone = trim($this->phone)?: null;
        $this->cellphone = trim($this->cellphone)?: null;
        $this->activities = trim($this->activities)?: null;
        $this->description = trim($this->description)?: null;
        return parent::preSave();
    }

    public function preValidate() : bool
    {
        return $this->preSave();
    }

    public function preInsert() : bool
    {
        return $this->preSave();
    }

    public function preUpdate() : bool
    {
        return $this->preSave();
    }

    public function postInsert() : void
    {
        if(!$this->getMainBranchId() && $this->branches()->count() > 0){
            $this->setMainBranchId($this->branches()[0]->getId());
            $this->save();
        }
    }

    /**
     * @return array|mixed|SysEntityBranch
     */
    public function mainBranch()
    {
        return SysEntityBranchQuery::findMainBranch($this);
    }

    /**
     * @param bool|true $noDeletes
     * @return \Propel\Runtime\Collection\ObjectCollection|SysEntityBranch[]
     */
    public function branches($noDeletes=true)
    {
        return SysEntityBranchQuery::findByEntity($this, $noDeletes);
    }

}