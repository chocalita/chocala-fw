<?php

use Base\JobOficioQuery as BaseJobOficioQuery;

/**
 *
 * @author ypra
 *
 * @method static JobOficioQuery createValids($noDeletes = true, $modelAlias = null, Criteria $criteria = null)
 * @method JobOficioQuery filterValids()
 */
class JobOficioQuery extends BaseJobOficioQuery implements SoftDeletion
{
    use SoftQuery;

}
