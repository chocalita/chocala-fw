<?php

use Base\SysEmailSent as BaseSysEmailSent;

/**
 * Class SysEmailSent
 * @author ypra
 */
class SysEmailSent extends BaseSysEmailSent
{

    public function emailOnly()
    {
        $parts = explode("<", $this->to_email);
        return $parts[0];
    }

}