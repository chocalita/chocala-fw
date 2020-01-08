<?php
/**
 * Description of AreaTecnicaService
 *
 * @author ypra
 */
class AreaTecnicaService extends GenericService
{

    /**
     * @var AreaTecnicaService
     */
    protected static $instance = null;

    /**
     * @return JobAreaTecnicaQuery
     */
    public function validsQuery($noDeletes=true)
    {
        return JobAreaTecnicaQuery::createValids($noDeletes);
    }

    /**
     * @param $pk
     * @return array|JobAreaTecnica|mixed
     * @throws NotFoundException
     */
    public function findPk($pk)
    {
        $areaTecnica = $this->validsQuery()->findPk($pk);
        if (!is_object($areaTecnica)) {
            throw new NotFoundException(ChocalaErrors::INVALID_RESOURCE);
        }
        return $areaTecnica;
    }

    /**
     * @param array $filters
     * @return JobAreaTecnica[]|\Propel\Runtime\Util\PropelModelPager
     */
    public function dataList($filters=[])
    {
        $query = $this->validsQuery()
            ->_if(isset($filters['nivel']))
                ->filterByNivel($filters['nivel'])
            ->_endif()
            ->_if(isset($filters['nombre']))
                ->filterByNombre('%'.$filters['nombre'].'%', Criteria::ILIKE)
            ->_endif()
            ->_if(isset($filters['keywords']))
                ->filterByKeywords('%'.$filters['keywords'].'%', Criteria::ILIKE)
            ->_endif()
            ->_if(isset($filters['descripcion']))
                ->filterByDescripcion('%'.$filters['descripcion'].'%', Criteria::ILIKE)
            ->_endif()
        ;
        $_page = $filters['_page']?: 1;
        $_max = $filters['_max']?: $query->count();
        return $query->paginate($_page, $_max);
    }

    /**
     * @param array $data
     * @param JobAreaTecnica|null $areaTecnica
     * @return array mixed
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function insertOrUpdate($data, &$areaTecnica=null)
    {
        if(!is_object($areaTecnica)){
            $areaTecnica = new JobAreaTecnica();
            $this->prepareInsert($areaTecnica);
        }
        else{
            $this->prepareUpdate($areaTecnica);
        }
        $areaTecnica->fromArray($data);
        $results['success'] = $areaTecnica->validate();
        if ($results['success']) {
            $areaTecnica->save();
        }
        $results['object'] = $areaTecnica;
        $results['errors'] = $areaTecnica->getErrorsMap();
        return $results;
    }
}