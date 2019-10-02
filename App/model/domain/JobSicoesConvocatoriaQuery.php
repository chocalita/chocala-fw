<?php

use Base\JobSicoesConvocatoriaQuery as BaseJobSicoesConvocatoriaQuery;

/**
 *
 * @author ypra
 *
 * @method static JobSicoesConvocatoriaQuery createValids($noDeletes = true, $modelAlias = null, Criteria $criteria = null)
 * @method JobSicoesConvocatoriaQuery filterValids()
 * @method JobSicoesConvocatoriaQuery orders()
 */
class JobSicoesConvocatoriaQuery extends BaseJobSicoesConvocatoriaQuery implements SoftDeletion
{
    use SoftQuery;

}
