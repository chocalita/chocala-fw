<?php

use Base\SysEntityUserQuery as BaseSysEntityUserQuery;

/**
 * @author ypra
 *
 * @method static SysEntityUserQuery createValids($noDeletes = true, $modelAlias = null, Criteria $criteria = null)
 * @method SysEntityUserQuery filterValids()
 */
class SysEntityUserQuery extends BaseSysEntityUserQuery// implements SoftDeletion
{
    use SoftQuery;

}