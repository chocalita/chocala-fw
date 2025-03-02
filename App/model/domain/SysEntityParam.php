<?php

use Base\SysEntityParam as BaseSysEntityParam;

/**
 *
 * @author ypra
 */
class SysEntityParam extends BaseSysEntityParam
{
    use Validatable;

    /**
     * @return bool|DateTime|float|string
     */
    public function value()
    {
        return SysParam::matchedValue($this->value, $this->getSysParam()->getType());
    }

}