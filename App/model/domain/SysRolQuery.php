<?php

namespace App\model\domain;

use Chocala\Behavior\SoftQuery;

use App\model\domain\Base\SysRolQuery as BaseSysRolQuery;

/**
 *
 * @author ypra
 *
 * @method static SysRolQuery createValids($noDeletes = true, $modelAlias = null, Criteria $criteria = null)
 * @method SysRolQuery filterValids()
 */
class SysRolQuery extends BaseSysRolQuery //implements SoftDeletion
{
    use SoftQuery;

    /**
     * @param SysUser $user
     * @param bool|true $noDeletes
     * @return \Propel\Runtime\Collection\ObjectCollection|SysRol[]
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public static function findByUser(SysUser $user, $noDeletes=true)
    {
        return self::createValids($noDeletes)
                ->useSysUserXRolQuery() // ->filterValids($noDeletes) //example anidated queries
                    ->filterBySysUser($user)
                ->endUse()
                ->orderByName()
            ->find();
    }

}