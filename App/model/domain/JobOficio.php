<?php

use Base\JobOficio as BaseJobOficio;

/**
 *
 *
 */
class JobOficio extends BaseJobOficio
{
    use Validatable;

    protected static $validationRules = array(
        'nombre' => array(
            'null' => false, 'blank'=> false,
            'size'=> array('min' => 3, 'max' => 50),
        ),
    );

}
