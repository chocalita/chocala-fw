<?php

/**
 * Description of AvisoService
 *
 * @author ypra
 */
class AvisoService extends GenericService
{

    /**
     * @var AvisoService
     */
    protected static $instance = null;

    /**
     * @return JobAvisoQuery
     */
    public function validsQuery($noDeletes = true)
    {
        return JobAvisoQuery::createValids($noDeletes);
    }

    /**
     * @param $pk
     * @return array|mixed|JobAviso
     * @throws ChocalaException
     */
    public function findPk($pk)
    {
        $aviso = $this->validsQuery()->findPk($pk);
        if (!is_object($aviso)) {
            throw new ChocalaException(ChocalaErrors::INVALID_RESOURCE);
        }
        return $aviso;
    }

    /**
     * @param array $filters
     * @return \Propel\Runtime\Util\PropelModelPager|JobAviso[]
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
     * @param bool|true $vigentes
     * @param string $order
     * @return JobAviso[]|\Propel\Runtime\Collection\ObjectCollection
     */
    public function listVigencia($vigentes = true, $order = Criteria::ASC)
    {
        $query = $this->validsQuery()
                ->filterVigentes(new DateTime(), $vigentes)
            ->orderByDestacado(Criteria::DESC)
            ->orderByFechaVencimiento($order);
        return $query->find();
    }


    /**
     * @return int
     */
    public function countVigentesMes()
    {
        // TODO: corregir que saque solo del mes actual
        return $this->validsQuery()
            ->filterPublicadasPeriodo(new DateTime(date('Y-') . (date('m') - 1) . '-01 00:00:00'),
                new DateTime())
            ->count();
    }

    public function countVigentesMesPasado()
    {
        // TODO: corregir que esaque solo del mes actual
        $endDate = new DateTime(date('Y-') . (date('m') - 1) . '-01 23:59:59');
        $endDate->modify("-1 day");
        return $this->validsQuery()
            ->filterPublicadasPeriodo(new DateTime(date('Y-') . (date('m') - 2) . '-01 00:00:00'),
                $endDate)
            ->count();
    }

    /**
     * @param array $data
     * @param JobAviso|null $aviso
     * @return array mixed
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function insertOrUpdate($data, &$aviso = null)
    {
        if (!is_object($aviso)) {
            $aviso = new JobAviso();
            $this->prepareInsert($aviso);
        } else {
            $this->prepareUpdate($aviso);
        }
        $aviso->fromArray($data);
//        $area = JobAreaQuery::create()->findPk($data['AreaId']);
//        $aviso->setJobArea($area);
        $results['success'] = $aviso->validate();
        if ($results['success']) {
            $aviso->save();
        }
        if ($data['picture']) {
            $aviso->setMimetype($data['picture']['type']);
            $aviso->setTieneImagen(true);
            $filedata = $data['picture'];
            $imageObj = new Image($filedata);
            $imageObj->saveResizeMax($aviso->imageDir(), AppParam::value(JobAviso::P_MAX_TAMANO_AVISO));
            $aviso->save();
        }
        $results['object'] = $aviso;
        $results['errors'] = $aviso->getErrorsMap();
        return $results;
    }

}