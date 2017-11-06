<?php

/**
 * Description of SuscriptorService
 *
 * @author ypra
 */
class SuscriptorService extends GenericService
{

    /**
     * @var SuscriptorService
     */
    protected static $instance = null;

    /**
     * @return JobSuscriptorQuery
     */
    public function validsQuery($noDeletes = true)
    {
        return JobSuscriptorQuery::createValids($noDeletes);
    }

    /**
     * @param $pk
     * @return array|mixed|JobSuscriptor
     * @throws ChocalaException
     */
    public function findPk($pk)
    {
        $suscriptor = $this->validsQuery()->findPk($pk);
        if (!is_object($suscriptor)) {
            throw new ChocalaException(ChocalaErrors::INVALID_RESOURCE);
        }
        return $suscriptor;
    }

    /**
     * @param array $filters
     * @return \Propel\Runtime\Util\PropelModelPager|JobSuscriptor[]
     */
    public function dataList($filters = [])
    {
        $query = $this->validsQuery()
            ->_if(isset($filters['code']))
            ->filterByDescripcion('%' . $filters['descripcion'] . '%', Criteria::ILIKE)
            ->_endif();

        //$query = nul;
        $_page = $filters['_page'] ?: 1;
        $_max = $filters['_max'] ?: $query->count();
        return $query->paginate($_page, $_max);
    }

    /**
     * @param array $data
     * @param JobSuscriptor|null $suscriptor
     * @return array mixed
     */
    public function insertOrUpdate($data, &$suscriptor = null)
    {
        if (!is_object($suscriptor)) {
            $suscriptor = new JobSuscriptor();
            $this->prepareInsert($suscriptor);
        } else {
            $this->prepareUpdate($suscriptor);
        }
        $suscriptor->fromArray($data);
//        $area = JobAreaQuery::create()->findPk($data['AreaId']);
//        $suscriptor->setJobArea($area);
        $results['success'] = $suscriptor->validate();
        if ($results['success']) {
            $suscriptor->save();
        }
        $results['object'] = $suscriptor;
        $results['errors'] = $suscriptor->getErrorsMap();
        return $results;
    }

    public function prepareInsert($object)
    {
        parent::prepareInsert($object);
        $object->setIp($_SERVER['REMOTE_ADDR']);
        $object->setStatus('INICIADO');
    }


}