<?php

use Base\SysEntityQuery as BaseSysEntityQuery;

/**
 *
 * @author ypra
 *
 * @method static SysEntityQuery createValids($noDeletes = true, $modelAlias = null, Criteria $criteria = null)
 * @method SysEntityQuery filterValids()
 */
class SysEntityQuery extends BaseSysEntityQuery //implements SoftDeletion
{
    use SoftQuery;

}
