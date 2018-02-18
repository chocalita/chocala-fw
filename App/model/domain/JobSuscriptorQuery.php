<?php

use Base\JobSuscriptorQuery as BaseJobSuscriptorQuery;

/**
 *
 * @author ypra
 *
 * @method static JobSuscriptorQuery createValids($noDeletes = true, $modelAlias = null, Criteria $criteria = null)
 * @method JobSuscriptorQuery filterValids()
 */
class JobSuscriptorQuery extends BaseJobSuscriptorQuery implements SoftDeletion
{
    use SoftQuery;

    public static function statusMap()
    {
        return JobSuscriptor::statusMap();
    }

    /**
     * @param DateTime $fecha
     * @param bool|true $vigentes
     * @return $this|mixed
     */
    public function filterVigentes($fecha, $vigentes = true)
    {
        echo "sas JobSuscriptoQuery::filterVigentes no corre";
        exit();
        return $this;
    }

}
