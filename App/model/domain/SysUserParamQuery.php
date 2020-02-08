<?php

use Base\SysUserParamQuery as BaseSysUserParamQuery;

/**
 *
 * @author ypra
 *
 * @method static SysUserParamQuery createValids($noDeletes = true, $modelAlias = null, Criteria $criteria = null)
 * @method SysUserParamQuery filterValids()
 */
class SysUserParamQuery extends BaseSysUserParamQuery //implements SoftDeletion
{
    use SoftQuery;

    /**
     * @param SysUser $user
     * @param bool|true $noDeletes
     * @return SysUserParamQuery
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public static function createForUser(SysUser $user, $noDeletes=true)
    {
        return self::createValids($noDeletes)
            ->filterBySysUser($user)
            ->useSysParamQuery()
               ->orderByName()
            ->endUse();
    }

}
