<?php
use Base\JobEmpresaSuscritaQuery as BaseJobEmpresaSuscritaQuery;

/**
 *
 * @author ypra
 *
 * @method static JobEmpresaSuscritaQuery createValids($noDeletes = true, $modelAlias = null, Criteria $criteria = null)
 * @method JobEmpresaSuscritaQuery filterValids()
 */
class JobEmpresaSuscritaQuery extends BaseJobEmpresaSuscritaQuery //implements SoftDeletion
{
    use SoftQuery;


}