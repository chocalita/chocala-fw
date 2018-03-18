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
    const STATUS_CONFIRMED = 'CONFIRMED';
    const STATUS_SUSCRIBED = 'SUSCRIBED';

    const EMPRESA_DIR = 'empresas/logo';

    static $validationRules = [
        'EntityTypeId' => [
            'null' => false, 'blank' => false,
        ],
        'LocationId' => [
            'null' => true, 'blank' => false,
            'validator' => true
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
            'validator' => true
        ],
        'Direccion' => [
            'null' => true, 'blank' => false,
            'size' => ['min' => 10, 'max' => 200],
            'validator' => true
        ],
        'Telefono' => [
            'null' => true, 'blank' => false,
            'size' => ['size' => 7, 'max' => 20],
            'validator' => 'validateTelefonos'
        ],
        'Celular' => [
            'null' => true, 'blank' => false,
            'size' => ['fix' => 8],
            'validator' => 'validateTelefonos'
        ],
    ];

    public function __validateLocationId($value)
    {
        if (!$this->isInitial() && !is_object($this->getSysLocation())) {
            return 'validate.required';
        }
        return true;
    }

    public function __validateNit($value)
    {
        if (!$this->isInitial() && $this->getSysEntityType()->esEmpresaFormal()) {
            if ($value != '') {
                //TODO: verificar que el nit sea unico
            } else {
                return 'validate.required';
            }
        }
        return true;
    }

    public function __validateDireccion($value)
    {
        if (!$this->isInitial() && Validation::isEmpty($this->direccion)) {
            return 'validate.required';
        }
        return true;
    }

    public function validateTelefonos($value)
    {
        if (!$this->isInitial() && Validation::isEmpty($this->telefono) && Validation::isEmpty($this->celular)) {
            return 'validate.telefonos';
        }
        return true;
    }


    public function preSave()
    {
        $this->setEntityTypeId($this->entity_type_id ?: null);
        $this->hash_code = trim($this->hash_code) ?: null;
        $this->nombre = ucwords(strtolower(trim($this->nombre))) ?: null;
        $this->email = trim(strtolower($this->email)) ?: null;
        $this->representante = ucwords(strtolower(trim($this->representante))) ?: null;
        //Informacion complementada en la confirmacion
        $this->setLocationId($this->location_id ?: null);
        $this->nit = trim($this->nit) ?: null;
        $this->direccion = trim($this->direccion) ?: null;
        $this->telefono = trim($this->telefono) ?: null;
        $this->celular = trim($this->celular) ?: null;
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

    public function isInitial()
    {
        return $this->status == self::STATUS_INITIAL;
    }

    /**
     * @return string
     */
    public function imageName()
    {
        return $this->hash_code . '.' . ImageMimeTypes::mimeExtensionFrom($this->getMimetype());
    }

    /**
     * @return string
     */
    public function imageDir()
    {
        return FilesHelper::dirPath(self::EMPRESA_DIR) . $this->imageName();
    }

    /**
     * @return string
     */
    public function imageWeb()
    {
        return FilesHelper::webPath(self::EMPRESA_DIR) . $this->imageName();
    }

}