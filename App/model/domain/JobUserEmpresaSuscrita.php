<?php

use Base\JobUserEmpresaSuscrita as BaseJobUserEmpresaSuscrita;

/**
 *
 */
class JobUserEmpresaSuscrita extends BaseJobUserEmpresaSuscrita implements JsonSerializable
{
    use  Validatable, Convertible;

    protected $active = true;

    static $validationRules = [
        'UserId' => [
            'null' => false, 'blank' => false,
        ],
        'EmpresaSuscritaId' => [
            'null' => false, 'blank' => false,
        ],
        'RolId' => [
            'null' => false, 'blank' => false,
        ],
        'Active' => [
            'null' => false, 'blank' => false,
        ],
    ];

    public function preSave()
    {
        $this->setUserId($this->user_id ?: null);
        $this->setEmpresaSuscritaId($this->empresa_suscrita_id ?: null);
        $this->setRolId($this->rol_id ?: null);
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
