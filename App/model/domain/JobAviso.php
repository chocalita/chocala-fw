<?php

use Base\JobAviso as BaseJobAviso;

/**
 *
 */
class JobAviso extends BaseJobAviso implements JsonSerializable
{
    use  Validatable, Convertible;

    const AVISOS_DIR = 'avisos';

    const P_MAX_TAMANO_AVISO = 'P_MAX_TAMANO_AVISO';

    const SIN_FORMACION = 'SIN FORMACION';
    const BACHILLER = 'BACHILLER';
    const TECNICO = 'TECNICO';
    const EGRESADO = 'EGRESADO';
    const LICENCIATURA = 'LICENCIATURA';
    const MAESTRIA = 'MAESTRIA';

    static $nivelesFormacion = [
        self::SIN_FORMACION, self::BACHILLER, self::TECNICO, self::EGRESADO, self::LICENCIATURA, self::MAESTRIA,
    ];

    /**
     * @return bool
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function isVigente()
    {
        return $this->getFechaVencimiento() >= new DateTime("now");
    }

    static $validationRules = [
        'AreaId' => [
            'null' => true, 'blank' => false,
            //TODO: revisar porque no valida blank
        ],
        'Cargo' => [
            'null' => false, 'blank' => false,
            'size' => ['min' => 3, 'max' => 100],
        ],
        'TelefonoContacto' => [
            'null' => true, 'blank' => false,
            'size' => ['min' => 7, 'max' => 20],
            'validator' => 'validateTelefonoCorreo'
        ],
        'CorreoContacto' => [
            'null' => true, 'blank' => false,
            'email' => true,
            'size' => ['min' => 10, 'max' => 100],
            'validator' => 'validateTelefonoCorreo'
        ],
        'Descripcion' => [
            'null' => true, 'blank' => false,
            'size' => ['min' => 10, 'max' => 5000],
            'validator' => true
        ],
        'Requisito' => [
            'null' => false, 'blank' => false,
            'size' => ['min' => 10, 'max' => 5000],
        ],
        'NombreEmpresa' => [
            'null' => false, 'blank' => false,
            'size' => ['min' => 2, 'max' => 500],
        ],
        'Direccion' => [
            'null' => true, 'blank' => false,
            'size' => ['min' => 5, 'max' => 200],
        ],
        'NivelFormacion' => [
            'null' => false, 'blank' => false,
        ],
        'FechaPublicacion' => [
            'null' => false, 'blank' => false,
        ],
        'FechaVencimiento' => [
            'null' => false, 'blank' => false,
        ],
        'Localizacion' => [
            'null' => false, 'blank' => false,
            'size' => ['min' => 2, 'max' => 200],
        ],
        'AreasReferencia' => [
            'null' => true, 'blank' => true,
            'size' => ['min' => 2, 'max' => 500],
        ],
        'FormacionesReferencia' => [
            'null' => false, 'blank' => false,
            'size' => ['min' => 2, 'max' => 2000],
        ],
    ];

    public function __validateDescripcion($value)
    {
        if ($this->getDestacado() && $this->getDescripcion() == '') {
            return 'validate.required';
        }
        return true;
    }

    public function validateTelefonoCorreo($value)
    {
        if ($this->getTelefonoContacto() == '' && $this->getCorreoContacto() == '') {
            return 'validate.telefonoCorreo';
        }
        return true;
    }

    public function preSave()
    {
        $this->descripcion = trim($this->descripcion) ?: null;
        $this->direccion = trim($this->direccion) ?: null;
        $this->telefono_contacto = trim($this->telefono_contacto) ?: null;
        $this->correo_contacto = trim($this->correo_contacto) ?: null;
        $this->areas_referencia = trim($this->areas_referencia) ?: null;
        $this->formaciones_referencia = trim($this->formaciones_referencia) ?: null;
        return parent::preSave();
    }

    public function preValidate()
    {
        return $this->preSave();
    }

    public function preInsert()
    {
        $this->creation_date = new DateUtil();
        $this->modification_date = new DateUtil();
        return $this->preSave();
    }

    public function preUpdate()
    {
        $this->modification_date = new DateUtil();
        return $this->preSave();
    }

    public function estadoVigente()
    {
        return $this->isVigente() ? 'Vigente' : 'Caduco';
    }

    /**
     * @return string
     */
    public function imageName()
    {
        return $this->id . '.' . ImageMimeTypes::mimeExtensionFrom($this->mimetype);
    }

    /**
     * @return string
     */
    public function imageDir()
    {
        return FilesHelper::dirPath(self::AVISOS_DIR) . $this->imageName();
    }

    /**
     * @return string
     */
    public function imageWeb()
    {
        return FilesHelper::webPath(self::AVISOS_DIR) . $this->imageName();
    }

    /**
     * @return array
     */
    public function listaAreasReferencia()
    {
        return explode(";", $this->areas_referencia);
    }

    /**
     * @return array
     */
    public function listaFormacionesReferencia()
    {
        return explode(";", $this->formaciones_referencia);
    }

    /**
     * @param TmpArea $areaReferencia
     * @return bool
     */
    public function tieneArea(TmpArea $areaReferencia)
    {
        return in_array($areaReferencia->getNombre(), $this->listaAreasReferencia());
    }

    /**
     * @param TmpFormacion $formacionReferencia
     * @return bool
     */
    public function tieneFormacion(TmpFormacion $formacionReferencia)
    {
        return in_array($formacionReferencia->getNombre(), $this->listaFormacionesReferencia());
    }

}