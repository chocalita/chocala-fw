<?php

use Base\SysEmailQuery as BaseSysEmailQuery;

/**
 * @author ypra
 *
 * @method static SysEmailQuery createValids($noDeletes = true, $modelAlias = null, Criteria $criteria = null)
 * @method SysEmailQuery filterValids()
 */
class SysEmailQuery extends BaseSysEmailQuery //implements SoftDeletion
{
    use SoftQuery;



}
