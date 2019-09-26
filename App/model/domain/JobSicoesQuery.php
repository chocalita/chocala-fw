<?php

use Base\JobSicoesQuery as BaseJobSicoesQuery;

/**
 *
 * @author ypra
 *
 * @method static JobSicoesQuery createValids($noDeletes = true, $modelAlias = null, Criteria $criteria = null)
 * @method JobSicoesQuery filterValids()
 * @method JobSicoesQuery orders()
 */
class JobSicoesQuery extends BaseJobSicoesQuery implements SoftDeletion
{
    use SoftQuery;

}
