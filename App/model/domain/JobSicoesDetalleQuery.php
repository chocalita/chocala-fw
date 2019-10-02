<?php

use Base\JobSicoesDetalleQuery as BaseJobSicoesDetalleQuery;

/**
 *
 * @author ypra
 *
 * @method static JobSicoesDetalleQuery createValids($noDeletes = true, $modelAlias = null, Criteria $criteria = null)
 * @method JobSicoesDetalleQuery filterValids()
 * @method JobSicoesDetalleQuery orders()
 *
 */
class JobSicoesDetalleQuery extends BaseJobSicoesDetalleQuery implements SoftDeletion
{
    use SoftQuery;

}
