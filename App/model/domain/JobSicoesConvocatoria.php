<?php

use Base\JobSicoesConvocatoria as BaseJobSicoesConvocatoria;

/**
 *
 *
 */
class JobSicoesConvocatoria extends BaseJobSicoesConvocatoria implements JsonSerializable
{
    use  Validatable, Convertible;

    static $validationRules = [
        'Cuce' => [
            'null' => false, 'blank' => false,
            'unique' => true,
            'size' => ['min' => 2, 'max' => 100],
        ],
        'CodigoSisin' => [
            'null' => true, 'blank' => false,
            'size' => ['min' => 2, 'max' => 100],
        ],
        'ObjetoLicitacion' => [
            'null' => false, 'blank' => false,
            'size' => ['min' => 5, 'max' => 5000],
        ],
        'NombreEntidad' => [
            'null' => false, 'blank' => false,
            'size' => ['min' => 6, 'max' => 2000],
        ],
        'CodigoEntidad' => [
            'null' => false, 'blank' => false,
            'size' => ['min' => 2, 'max' => 50],
        ],
        'TelefonoEntidad' => [
            'null' => false, 'blank' => false,
            'size' => ['min' => 5, 'max' => 100],
        ],
        'FechaPublicacion' => [
            'null' => false, 'blank' => false,
        ],
        'FechaLimite' => [
            'null' => false, 'blank' => false,
        ],
        'Estado' => [
            'null' => false, 'blank' => false,
            'size' => ['min' => 2, 'max' => 10],
        ],
        'Modalidad' => [
            'null' => false, 'blank' => false,
            'size' => ['min' => 5, 'max' => 200],
        ],
        'TipoConvocatoria' => [
            'null' => false, 'blank' => false,
            'size' => ['min' => 5, 'max' => 200],
        ],
        'TipoConsultoria' => [
            'null' => false, 'blank' => false,
            'size' => ['min' => 5, 'max' => 200],
        ],
        'FormaAdjudicacion' => [
            'null' => false, 'blank' => false,
            'size' => ['min' => 5, 'max' => 200],
        ],
        'TipoContratacion' => [
            'null' => false, 'blank' => false,
            'size' => ['min' => 5, 'max' => 200],
        ],
        'GarantiasSolicitadas' => [
            'null' => false, 'blank' => false,
            'size' => ['min' => 5, 'max' => 2000],
        ],
        'Enlace' => [
            'null' => true, 'blank' => false,
            'size' => ['min' => 5, 'max' => 5000],
        ],
        'Departamento' => [
            'null' => false, 'blank' => false,
            'size' => ['min' => 5, 'max' => 50],
        ],
        'Contacto' => [
            'null' => false, 'blank' => false,
            'size' => ['min' => 5, 'max' => 500],
        ],
        'Status' => [
            'null' => true, 'blank' => false,
            'size' => ['min' => 2, 'max' => 30],
        ],
    ];

    public function preSave()
    {
        $this->cuce = trim($this->cuce) ?: null;
        $this->codigo_sisin = trim($this->codigo_sisin) ?: null;
        $this->objeto_licitacion = trim($this->objeto_licitacion) ?: null;
        $this->nombre_entidad = trim($this->nombre_entidad) ?: null;
        $this->codigo_entidad = trim($this->codigo_entidad) ?: null;
        $this->telefono_entidad = trim($this->telefono_entidad) ?: null;
        $this->fecha_publicacion = $this->fecha_publicacion ?: null;
        $this->fecha_limite = $this->fecha_limite ?: null;
        $this->estado = trim($this->estado) ?: null;
        $this->modalidad = trim($this->modalidad) ?: null;
        $this->tipo_convocatoria = trim($this->tipo_convocatoria) ?: null;
        $this->tipo_consultoria = trim($this->tipo_consultoria) ?: null;
        $this->forma_adjudicacion = trim($this->forma_adjudicacion) ?: null;
        $this->tipo_contratacion = trim($this->tipo_contratacion) ?: null;
        $this->garantias_solicitadas = trim($this->garantias_solicitadas) ?: null;
        $this->enlace = trim($this->enlace) ?: null;
        $this->departamento = trim($this->departamento) ?: null;
        $this->contacto = trim($this->contacto) ?: null;
        $this->status = trim($this->status) ?: null;
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

}
