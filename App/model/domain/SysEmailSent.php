<?php

use Base\SysEmailSent as BaseSysEmailSent;

/**
 * Class SysEmailSent
 * @author ypra
 */
class SysEmailSent extends BaseSysEmailSent implements JsonSerializable
{
    use  Validatable, Convertible;

    static array $validationRules = [
        'ShippingDate' => [
            'null' => false,
        ],
    ];

    public function preSave() : bool
    {
        return parent::preSave();
    }

    public function preValidate() : bool
    {
        return $this->preSave();
    }

    public function preInsert() : bool
    {
        return $this->preSave();
    }

    public function preUpdate() : bool
    {
        return $this->preSave();
    }


    public function emailOnly() : string
    {
        $parts = explode("<", $this->to_email);
        return $parts[0];
    }

}