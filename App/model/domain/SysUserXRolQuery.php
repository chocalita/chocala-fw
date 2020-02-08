<?php

use Base\SysUserXRolQuery as BaseSysUserXRolQuery;

/**
 *
 * @author ypra
 *
 *
 * @method static SysUserXRolQuery createValids($noDeletes = true, $modelAlias = null, Criteria $criteria = null)
 * @method SysUserXRolQuery filterValids()
 */
class SysUserXRolQuery extends BaseSysUserXRolQuery //implements SoftDeletion
{
    use SoftQuery;

}