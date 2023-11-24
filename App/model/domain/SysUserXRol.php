<?php

namespace App\model\domain;

use Chocala\Behavior\Validatable;

use App\model\domain\Base\SysUserXRol as BaseSysUserXRol;

/**
 *
 * @author: ypra
 */
class SysUserXRol extends BaseSysUserXRol
{
    use Validatable;

    static $validationRules = array(
        'UserId' => array(
//            'null' => true, 'blank'=> false, unique => 'RolId',
        ),
        'RolId' => array(
//            'null' => true, 'blank'=> false, unique => 'UserId',
        ),
    );


}