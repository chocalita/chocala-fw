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

    const STATUS_INITIAL = 'INITIAL';
    const STATUS_SUSCRIBED = 'SUSCRIBED';

    static $validationRules = [
        'EntityTypeId' => [
            'null' => false, 'blank' => false,
        ],
        'LocationId' => [
            'null' => true, 'blank' => false,
        ],
        'HashCode' => [
            'null' => true, 'blank' => false,
            'unique' => true,
            'size' => ['min' => 2, 'max' => 50],
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
        'Nit' => [
            'null' => true, 'blank' => false,
            'unique' => true,
            'size' => ['min' => 5, 'max' => 20],
        ],
        'Direccion' => [
            'null' => true, 'blank' => false,
            'size' => ['min' => 10, 'max' => 200],
        ],
        'Telefono' => [
            'null' => true, 'blank' => false,
            'size' => ['size' => 7, 'max' => 20],
        ],
        'Celular' => [
            'null' => true, 'blank' => false,
            'size' => ['fix' => 8],
        ],
    ];

    public function preSave()
    {
        $this->entity_type_id = trim(strtolower($this->entity_type_id)) ?: null;
        $this->hash_code = trim($this->hash_code) ?: null;
        $this->nombre = ucwords(strtolower(trim($this->nombre))) ?: null;
        $this->email = trim(strtolower($this->email)) ?: null;
        $this->representante = ucwords(strtolower(trim($this->representante))) ?: null;

        $this->nit = trim(strtolower($this->nit)) ?: null;

        $this->direccion = trim(strtolower($this->direccion)) ?: null;
        $this->telefono = trim(strtolower($this->telefono)) ?: null;
        $this->celular = trim(strtolower($this->celular)) ?: null;
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
