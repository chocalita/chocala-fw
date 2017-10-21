<?php

use Base\JobAreaQuery as BaseJobAreaQuery;

/**
 * @author ypra
 *
 * @method static JobAreaQuery createValids($noDeletes = true, $modelAlias = null, Criteria $criteria = null)
 * @method JobAreaQuery filterValids()
 *
 */
class JobAreaQuery extends BaseJobAreaQuery implements SoftDeletion
{

    use SoftQuery;
    
    public static function data()
    {
        return self::create()->orderByName();
    }

}
