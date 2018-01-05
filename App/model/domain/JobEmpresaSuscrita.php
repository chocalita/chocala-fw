<?php

use Base\JobEmpresaSuscrita as BaseJobEmpresaSuscrita;

/**
 *
 */
class JobEmpresaSuscrita extends BaseJobEmpresaSuscrita implements JsonSerializable
{
    use  Validatable, Convertible;

    const EMAIL_SUBSCRIPTION = 'J_EMAIL_ENTITY_SUBSCRIPTION';

    const EMAIL_SUCCESS_SUBSCRIPTION = 'J_EMAIL_SUCCESS_SUBSCRIPTION';

    static $validationRules = [
        'EntityTypeId' => [
            'null' => false, 'blank' => false,
        ],
        'Nombre' => [
            'null' => false, 'blank' => false,
            'unique' => true,
            'size' => ['min' => 2, 'max' => 250],
        ],
        'Email' => [
            'null' => false, 'blank' => false,
            'email' => true, 'unique' => true,
            'size' => ['min' => 10, 'max' => 100],
        ],
        'Representante' => [
            'null' => false, 'blank' => false,
            'size' => ['min' => 2, 'max' => 100],
        ],
    ];

    public function preSave()
    {
        $this->entity_type_id= trim(strtolower($this->entity_type_id))?: null;
        $this->nombre = ucwords(strtolower(trim($this->nombre)))?: null;
        $this->email= trim(strtolower($this->email))?: null;
        $this->representante = ucwords(strtolower(trim($this->representante)))?: null;
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
