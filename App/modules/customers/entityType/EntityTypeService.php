<?php
/**
 * @author ypra
 * Date: 11/2/2016
 * Time: 4:12 PM
 *
 */
class EntityTypeService extends GenericService
{

    /**
    * @var EntityTypeService
    */
    protected static $instance = null;

    /**
     * @return SysEntityTypeQuery
     */
    public function validsQuery($noDeletes=true)
    {
        return SysEntityTypeQuery::createValids($noDeletes);
    }

    /**
     * @param $pk
     * @return array|mixed|SysEntityType
     * @throws NotFoundException
     */
    public function findPk($pk)
    {
        $entityType = $this->validsQuery()->findPk($pk);
        if (!is_object($entityType)) {
            throw new NotFoundException(ChocalaErrors::INVALID_RESOURCE);
        }
        return $entityType;
    }

    /**
     * @param array $filters
     * @return SysEntityType[]|mixed
     */
    public function dataList($filters=[])
    {
        $query = $this->validsQuery()
            ->_if(isset($filters['groupCode']) && !is_array($filters['groupCode']))
                ->filterByGroupCode($filters['groupCode'])
            ->_endif()
            ->_if(isset($filters['groupCode']) && is_array($filters['groupCode']))
                ->filterByGroupCode($filters['groupCode'], Criteria::IN)
            ->_endif()
            ->_if(isset($filters['code']))
                ->filterByCode('%'.$filters['code'].'%', Criteria::ILIKE)
            ->_endif()
            ->_if(isset($filters['name']))
                ->filterByName('%'.$filters['name'].'%', Criteria::ILIKE)
            ->_endif()
            ->orderByGroupCode()
            ->orderByName()
        ;

        $_page = $filters['_page']?: 1;
        $_max = $filters['_max']?: $query->count();
        return $query->paginate($_page, $_max);
    }

    /**
     * @param array $data
     * @param null $entityType
     * @return array|mixed
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function insertOrUpdate($data, &$entityType = null)
    {
        if(!is_object($entityType)){
            $entityType = new SysEntityType();
        }
        $entityType->fromArray($data);
        $results['success'] = $entityType->validate();
        if ($results['success']) {
            $entityType->save();
        }
        $results['object'] = $entityType;
        $results['errors'] = $entityType->getErrorsMap();
        return $results;
    }

}