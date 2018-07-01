<?php

use Base\JobAvisoQuery as BaseJobAvisoQuery;

/**
 *
 * @author ypra
 *
 * @method static JobAvisoQuery createValids($noDeletes = true, $modelAlias = null, Criteria $criteria = null)
 * @method JobAvisoQuery filterValids()
 * @method JobAvisoQuery orders()
 */
class JobAvisoQuery extends BaseJobAvisoQuery implements SoftDeletion
{
    use SoftQuery;

    /**
     * @param DateTime $fecha
     * @param bool|true $vigentes
     * @return $this|mixed
     */
    public function filterVigentes($fecha, $vigentes = true)
    {
        return $this
            ->filterByCreationDate($fecha, Criteria::LESS_THAN)
            ->_if($vigentes)
                ->filterByFechaVencimiento($fecha,Criteria::GREATER_EQUAL)
            ->_else()
                ->filterByFechaVencimiento($fecha, Criteria::LESS_THAN)
            ->_endif();
    }

    /**
     * @param DateTime $fechaIni
     * @param DateTime $fechaFin
     * @return $this|JobAvisoQuery
     */
    public function filterPublicadasPeriodo($fechaIni, $fechaFin)
    {
        return $this->filterByFechaVencimiento($fechaIni, Criteria::GREATER_EQUAL)
            ->filterByFechaPublicacion($fechaFin, Criteria::LESS_THAN);
    }

}