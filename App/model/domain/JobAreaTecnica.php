<?php

use Base\JobAreaTecnica as BaseJobAreaTecnica;

/**
 *
 *
 */
class JobAreaTecnica extends BaseJobAreaTecnica
{
    use Validatable;
//    protected $status = SoftDelete::ACTIVE;

    static $validationRules = [
        'Nombre' => [
            'null' => false, 'blank' => false, 'unique' => false,
            'size' => ['min' => 3, 'max' => 100],
        ],
        'Descripcion' => [
            'null' => false, 'blank' => false,
            'size' => ['min' => 2, 'max' => 1000],
        ],
        'Status' => [
            'null' => false, 'blank' => false,
        ],
    ];

    public function r()
    {
        $this->collJobAreaRelacionadasRelatedByIdArea1;
    }

}
