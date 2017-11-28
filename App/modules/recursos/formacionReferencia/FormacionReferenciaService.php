<?php

/**
 * Description of FormacionReferenciaService
 *
 * @author ypra
 */
class FormacionReferenciaService extends GenericService
{

    /**
     * @var FormacionReferenciaService
     */
    protected static $instance = null;

    /**
     * @return TmpFormacionQuery
     */
    public function validsQuery($noDeletes = true)
    {
        return TmpFormacionQuery::createValids($noDeletes);
    }

    /**
     * @param $pk
     * @return array|TmpFormacion|mixed
     * @throws ChocalaException
     */
    public function findPk($pk)
    {
        $formacion = $this->validsQuery()->findPk($pk);
        if (!is_object($formacion)) {
            throw new ChocalaException(ChocalaErrors::INVALID_RESOURCE);
        }
        return $formacion;
    }

    /**
     * @param array $filters
     * @return TmpFormacion[]|\Propel\Runtime\Util\PropelModelPager
     */
    public function dataList($filters = [])
    {
        $query = $this->validsQuery()
            ->_if(isset($filters['nombre']))
                ->filterByNombre('%' . $filters['nombre'] . '%', Criteria::ILIKE)
            ->_endif()
            ->orderByNombre();
        $_page = $filters['_page'] ?: 1;
        $_max = $filters['_max'] ?: $query->count();
        return $query->paginate($_page, $_max);
    }

    /**
     * @param array $data
     * @param TmpFormacion|null $formacion
     * @return array mixed
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function insertOrUpdate($data, &$formacion = null)
    {
        if (!is_object($formacion)) {
            $formacion = new TmpFormacion();
        }
        $formacion->fromArray($data);
        $results['success'] = $formacion->validate();
        if ($results['success']) {
            $formacion->save();

            if ($data['FormacionesReferencia'] != '') {
                $formacionesReferencia = explode(';', $data['FormacionesReferencia']);
                foreach ($formacionesReferencia as $formacionReferencia) {
                    $formacionTmp = $this->validsQuery()->findOneByNombre($formacionReferencia);
                    if (is_object($formacionTmp) && !$formacionTmp->tieneFormacion($formacion)) {
                        $formacionesStr = $formacion->getNombre();
                        if (sizeof($formacionTmp->listaFormacionesReferencia()) > 0) {
                            $formacionesStr .= ';' . $formacionTmp->getFormacionesReferencia();
                        }
                        $formacionTmp->setFormacionesReferencia($formacionesStr);
                        $formacionTmp->save();
                    }
                }
            }

        }
        $results['object'] = $formacion;
        $results['errors'] = $formacion->getErrorsMap();
        return $results;
    }

    /**
     * @param $tmpFormacionNombre
     * @param DateTime|null $dateTime
     * @return JobAviso[]|\Propel\Runtime\Collection\ObjectCollection
     */
    public function avisosVigentes($tmpFormacionNombre, DateTime $dateTime = null)
    {
        if ($dateTime == '') {
            $dateTime = new DateUtil();
        }
        return JobAvisoQuery::create()
                ->filterVigentes($dateTime)
                ->filterByCreationDate($dateTime, Criteria::LESS_EQUAL)
                ->filterByFormacionesReferencia("%{$tmpFormacionNombre}%",
                    Criteria::LIKE)
            ->find();
    }

}