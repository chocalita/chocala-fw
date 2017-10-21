<?php

use Base\JobAreaRelacionada as BaseJobAreaRelacionada;

/**
 *
 *
 */
class JobAreaRelacionada extends BaseJobAreaRelacionada
{
    use Validatable;

    protected static $validationRules = array(

    );

    public function noPoner()
    {
        $this->aJobAreaTecnicaRelatedByIdArea1;
    }

}
