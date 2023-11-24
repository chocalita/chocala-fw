<?php

namespace App\model\domain;

use Chocala\Behavior\SoftQuery;

use App\model\domain\Base\SysUriQuery as BaseSysUriQuery;

/**
 *
 * @author: ypra
 *
 * @method static SysUriQuery createValids($noDeletes = true, $modelAlias = null, Criteria $criteria = null)
 * @method SysUriQuery filterValids()
 */
class SysUriQuery extends BaseSysUriQuery //implements SoftDeletion
{
    use SoftQuery;

}