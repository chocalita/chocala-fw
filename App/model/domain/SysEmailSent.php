<?php

use Base\SysEmailSent as BaseSysEmailSent;

/**
 * Class SysEmailSent
 * @author ypra
 */
class SysEmailSent extends BaseSysEmailSent implements JsonSerializable
{
    use  Validatable, Convertible;

    static $validationRules = [
        'ShippingDate' => [
            'null' => false,
        ],
    ];

    public function preSave()
    {
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


    public function emailOnly()
    {
        $parts = explode("<", $this->to_email);
        return $parts[0];
    }

}