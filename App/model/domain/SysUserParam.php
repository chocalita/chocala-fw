<?php

use Base\SysUserParam as BaseSysUserParam;

/**
 *
 * @author ypra
 */
class SysUserParam extends BaseSysUserParam
{
    use Validatable;

    /**
     * @return bool|DateTime|float|string
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function value()
    {
        return SysParam::matchedValue($this->value, $this->getSysParam()->getType());
    }

}
