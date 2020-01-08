<?php
/**
 * Description of AreaService
 *
 * @author ypra
 */
class AreaService extends GenericService
{

    /**
     * @var AreaService
     */
    protected static $instance = null;

    /**
     * @return JobAreaQuery
     */
    public function validsQuery($noDeletes=true)
    {
        return JobAreaQuery::createValids($noDeletes);
    }

    /**
     * @param $pk
     * @return array|JobArea|mixed
     * @throws NotFoundException
     */
    public function findPk($pk)
    {
        $area = $this->validsQuery()->findPk($pk);
        if (!is_object($area)) {
            throw new NotFoundException(ChocalaErrors::INVALID_RESOURCE);
        }
        return $area;
    }

    /**
     * @param array $filters
     * @return JobArea[]|\Propel\Runtime\Util\PropelModelPager
     */
    public function dataList($filters=[])
    {
        $query = $this->validsQuery()
            ->_if(isset($filters['codigo']))
                ->filterByCodigo('%'.$filters['codigo'].'%', Criteria::ILIKE)
            ->_endif()
            ->_if(isset($filters['nombre']))
                ->filterByNombre('%'.$filters['nombre'].'%', Criteria::ILIKE)
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
     * @param JobArea|null $area
     * @return array mixed
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function insertOrUpdate($data, &$area=null)
    {
        if(!is_object($area)){
            $area = new JobArea();
        }
        $area->fromArray($data);
        $results['success'] = $area->validate();
        if ($results['success']) {
            $area->save();
        }
        $results['object'] = $area;
        $results['errors'] = $area->getErrorsMap();
        return $results;
    }

}