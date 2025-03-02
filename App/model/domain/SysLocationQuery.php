<?php

use Base\SysLocationQuery as BaseSysLocationQuery;

/**
 *
 * @author: ypra
 *
 * @method static SysLocationQuery createValids($noDeletes = true, $modelAlias = null, Criteria $criteria = null)
 * @method SysLocationQuery filterValids()
 */
class SysLocationQuery extends BaseSysLocationQuery implements SoftDeletion
{
    use SoftQuery;

}