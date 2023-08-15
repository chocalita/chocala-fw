<?php

use Base\SysRolXUri as BaseSysRolXUri;

/**
 *
 * @author ypra
 */
class SysRolXUri extends BaseSysRolXUri
{
    use Validatable;

    static array $validationRules = [
        'RolId' => [
            'null' => false, 'blank'=> false,
            'unique' => 'UriId'
        ],
        'UriId' => [
            'null' => false, 'blank'=> false,
            'unique' => 'UriId'
        ],
    ];

}