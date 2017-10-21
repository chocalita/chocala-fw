<?php

use Base\SysEntityTypeQuery as BaseSysEntityTypeQuery;

/**
 *
 * @author ypra
 *
 * @method static SysEntityTypeQuery createValids($noDeletes = true, $modelAlias = null, Criteria $criteria = null)
 * @method SysEntityTypeQuery filterValids()
 */
class SysEntityTypeQuery extends BaseSysEntityTypeQuery //implements SoftDeletion
{
    use SoftQuery;

}