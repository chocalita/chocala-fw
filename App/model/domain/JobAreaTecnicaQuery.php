<?php

use Base\JobAreaTecnicaQuery as BaseJobAreaTecnicaQuery;

/**
 * @author ypra
 *
 * @method static JobAreaQuery createValids($noDeletes = true, $modelAlias = null, Criteria $criteria = null)
 * @method JobAreaQuery filterValids()
 *
 */
class JobAreaTecnicaQuery extends BaseJobAreaTecnicaQuery implements SoftDeletion
{
    use SoftQuery;

    public static function data()
    {
        return self::create()->orderByName();
    }
}
