<?php
/**
 * Description of AreaReferenciaService
 *
 * @author ypra
 */
class AreaReferenciaService extends GenericService
{

    /**
     * @var AreaReferenciaService
     */
    protected static $instance = null;

    /**
     * @return TmpAreaQuery
     */
    public function validsQuery($noDeletes=true)
    {
        return TmpAreaQuery::createValids($noDeletes);
    }

    /**
     * @param $pk
     * @return array|TmpArea|mixed
     * @throws ChocalaException
     */
    public function findPk($pk)
    {
        $area = $this->validsQuery()->findPk($pk);
        if (!is_object($area)) {
            throw new ChocalaException(ChocalaErrors::INVALID_RESOURCE);
        }
        return $area;
    }

    /**
     * @param array $filters
     * @return TmpArea[]|\Propel\Runtime\Util\PropelModelPager
     */
    public function dataList($filters=[])
    {
        $query = $this->validsQuery()
            ->_if(isset($filters['nombre']))
                ->filterByNombre('%'.$filters['nombre'].'%', Criteria::ILIKE)
            ->_endif()
        ;
        $_page = $filters['_page']?: 1;
        $_max = $filters['_max']?: $query->count();
        return $query->paginate($_page, $_max);
    }

    /**
     * @param array $data
     * @param TmpArea|null $area
     * @return array mixed
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function insertOrUpdate($data, &$area=null)
    {
        if(!is_object($area)){
            $area = new TmpArea();
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