<?php

use Base\SysModuleQuery as BaseSysModuleQuery;

/**
 * 
 * @author: ypra
 *
 * @method static SysModuleQuery createValids($noDeletes = true, $modelAlias = null, Criteria $criteria = null)
 * @method SysModuleQuery filterValids()
 */
class SysModuleQuery extends BaseSysModuleQuery //implements SoftDeletion
{
    use SoftQuery;

}