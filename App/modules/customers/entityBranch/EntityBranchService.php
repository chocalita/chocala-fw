<?php
/**
 * @author ypra
 * Date: 11/02/2015
 * Time: 10:19 PM
 *
 */
class EntityBranchService extends GenericService
{

    /**
     * @var EntityBranchService
     */
    protected static $instance = null;

    /**
     * @param bool|true $noDeletes
     * @return SysEntityBranchQuery
     */
    public function validsQuery($noDeletes=true)
    {
        return SysEntityBranchQuery::createValids($noDeletes);
    }

    /**
     * @param $pk
     * @return array|mixed|SysEntityBranch
     * @throws ChocalaException
     */
    public function findPk($pk)
    {
        $entityBranch = $this->validsQuery()->findPk($pk);
        if (!is_object($entityBranch)) {
            throw new ChocalaException(ChocalaErrors::INVALID_RESOURCE);
        }
        return $entityBranch;
    }

    /**
     * @param array $filters
     * @return \Propel\Runtime\Util\PropelModelPager|SysEntityBranch[]
     */
    public function dataList($filters=[])
    {
        $query = $this->validsQuery()
            ->_if(isset($filters['code']))
                ->filterByCode('%'.$filters['code'].'%', Criteria::ILIKE)
            ->_endif()
            ->_if(isset($filters['name']))
                ->filterByComercialName('%'.$filters['name'].'%', Criteria::ILIKE)
                ->_or()
                ->filterByFormalName('%'.$filters['name'].'%', Criteria::ILIKE)
            ->_endif()
            ->orderByComercialName()
        ;
        $_page = $filters['_page']?: 1;
        $_max = $filters['_max']?: $query->count();
        return $query->paginate($_page, $_max);
    }

    /**
     * @param array $data
     * @param SysEntityBranch|null $entityBranch
     * @return array mixed
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function insertOrUpdate($data, &$entityBranch=null)
    {
        if(!is_object($entityBranch)){
            $entityBranch = new SysEntityBranch();
        }
        $entityBranch->fromArray($data);
        $results['success'] = $entityBranch->validate();
        if ($results['success']) {
            $entityBranch->save();
        }
        $results['object'] = $entityBranch;
        $results['errors'] = $entityBranch->getErrorsMap();
        return $results;
    }

}