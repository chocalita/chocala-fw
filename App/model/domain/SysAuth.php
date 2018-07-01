<?php

use Base\SysAuth as BaseSysAuth;

/**
 * Skeleton subclass for representing a row from the 'sys_auth' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class SysAuth extends BaseSysAuth
{
    use Validatable;

    const TYPE_FACEBOOK = "FACEBOOK";
    static $validationRules = [
        'AccessToken' => [
            'null' => false, 'blank' => false, 'unique' => false,
        ],
        'Type' => [
            'null' => false, 'blank' => false, 'unique' => false,
        ],
        'UserId' => [
            'null' => false, 'blank' => false, 'unique' => false,
        ],
    ];

}
