<?php

use Base\TmpFormacion as BaseTmpFormacion;

/**
 *
 */
class TmpFormacion extends BaseTmpFormacion implements JsonSerializable
{
    use  Validatable, Convertible;

    static $validationRules = [
        'Nombre' => [
            'null' => false, 'blank' => false, 'unique' => true,
            'size' => ['min' => 3, 'max' => 100],
        ],
        'Keywords' => [
            'null' => true, 'blank' => false,
            'size' => ['min' => 2, 'max' => 5000],
        ],
        'AreasReferencia' => [
            'null' => true, 'blank' => false,
            'size' => ['min' => 2, 'max' => 2000],
        ],
        'FormacionesReferencia' => [
            'null' => true, 'blank' => false,
            'size' => ['min' => 2, 'max' => 2000],
        ],
    ];

    public function preSave()
    {
        $this->nombre = trim($this->nombre) ?: null;
        $this->keywords = trim($this->keywords) ?: null;
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
        return $this->preSave();
    }

    public function preUpdate()
    {
        return $this->preSave();
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