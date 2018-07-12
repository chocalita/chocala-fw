<?php

use Base\SysEmailSent as BaseSysEmailSent;

/**
 * Class SysEmailSent
 * @author ypra
 */
class SysEmailSent extends BaseSysEmailSent
{

    public function preSave()
    {

    }

    public function preValidate()
    {
        return $this->preSave();
    }

    public function preInsert()
    {
        return $this->preSave();
        $this->shipping_date = new DateUtil();
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