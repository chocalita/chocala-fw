<?php

/**
 * Description of AvisoService
 *
 * @author ypra
 */
class AvisoService extends AppSecureService
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
     * @throws NotFoundException
     */
    public function findPk($pk)
    {
        $aviso = $this->validsQuery()->findPk($pk);
        if (!is_object($aviso)) {
            throw new NotFoundException(ChocalaErrors::INVALID_RESOURCE);
        }
        return $aviso;
    }

    /**
     * @param array $filters
     * @return JobAviso[]|\Propel\Runtime\Util\PropelModelPager
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function dataList($filters = [])
    {
        $orders = $filters['_order'] ?: ['FechaVencimiento' => Criteria::DESC];
        $query = $this->validsQuery()
            ->_if(isset($filters['_fechaVigencia']))
                ->filterVigentes($filters['_fechaVigencia'])
            ->_endif()
            ->_if(isset($filters['_fechaNoVigencia']))
                ->filterVigentes($filters['_fechaNoVigencia'], false)
            ->_endif()
            ->_if(isset($filters['empresaSuscrita']))
                ->filterByJobEmpresaSuscrita($filters['empresaSuscrita'])
            ->_endif()
            ->_if(isset($filters['cargo']))
                ->filterByCargo('%' . $filters['cargo'] . '%', Criteria::ILIKE)
            ->_endif()
            ->_if(isset($filters['descripcion']))
                ->filterByDescripcion('%' . $filters['descripcion'] . '%', Criteria::ILIKE)
            ->_endif()
            ->_if(isset($filters['nombreEmpresa']))
                ->filterByNombreEmpresa('%' . $filters['nombreEmpresa'] . '%', Criteria::ILIKE)
            ->_endif()
            ->_if(isset($filters['nivelFormacion']))
                ->filterByNivelFormacion($filters['nivelFormacion'] , Criteria::EQUAL)
            ->_endif()
            ->_if(isset($filters['profesion']))
                ->filterByProfesion('%' . $filters['profesion'] . '%', Criteria::ILIKE)
            ->_endif()
            ->_if(isset($filters['status']))
                ->filterByStatus($filters['status'] , Criteria::EQUAL)
            ->_endif()
            ->orders($orders);
        $_page = $filters['_page'] ?: 1;
        $_max = $filters['_max'] ?: $query->count();
        return $query->paginate($_page, $_max);
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
        $endDate = new DateTime(date('Y-') . (date('m')) . '-01 23:59:59');
        $endDate->modify("-1 day");
        return $this->validsQuery()
            ->filterPublicadasPeriodo(new DateTime(date('Y-') . (date('m') - 1) . '-01 00:00:00'),
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

    /**
     * @param bool $vigentes
     * @param array $filters
     * @return JobAviso[]|\Propel\Runtime\Util\PropelModelPager
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function listVigentes($vigentes = true, $filters = [])
    {
        $filters['_order'] = $filters['_order'] ?: [
            'Destacado' => Criteria::DESC,
            'FechaVencimiento' => Criteria::ASC
        ];
        if($vigentes){
            $filters['_fechaVigencia'] = $filters['_fechaVigencia'] ?: new DateTime();
        } else {
            $filters['_fechaNoVigencia'] = $filters['_fechaNoVigencia'] ?: new DateTime();
        }
        return $this->dataList($filters);
    }

    /**
     * @param JobEmpresaSuscrita $empresaSuscrita
     * @param $vigentes
     * @param array $filters
     * @return JobAviso[]|\Propel\Runtime\Util\PropelModelPager
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function vigentesEmpresa(JobEmpresaSuscrita $empresaSuscrita, $vigentes, $filters = [])
    {
        $filters['empresaSuscrita'] = $empresaSuscrita;
        $filters['_order'] = $filters['_order'] ?: [
//            'Destacado' => Criteria::DESC,
            'FechaVencimiento' => Criteria::ASC
        ];
        return $this->listVigentes($vigentes, $filters);
    }

}