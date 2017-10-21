<?php

/**
 * Class EntityUserService
 */
class EntityUserService extends GenericService
{

    /**
     * @var EntityUserService
     */
    protected static $instance = null;

    /**
     * @param bool|true $noDeletes
     * @return SysEntityUserQuery
     */
    public function validsQuery($noDeletes=true)
    {
        return SysEntityUserQuery::createValids($noDeletes);
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
     * @return \Propel\Runtime\Util\PropelModelPager|SysEntityUser[]
     */
    public function dataList($filters=[])
    {
        $query = $this->validsQuery()
            ->_if(isset($filters['entityId']))
                ->filterByEntityId($filters['entityId'])
            ->_endif()
            ->_if(isset($filters['userId']))
                ->filterByUserId($filters['userId'])
            ->_endif()
            ->_if(isset($filters['rolId']))
                ->filterByRolId($filters['rolId'])
            ->_endif()
            ->_if(isset($filters['active']))
                ->filterByActive($filters['active'])
            ->_endif()
            ->useSysUserQuery()
                ->orderByFormalName()
            ->endUse()
        ;
        $_page = $filters['_page']?: 1;
        $_max = $filters['_max']?: $query->count();
        return $query->paginate($_page, $_max);
    }

    /**
     * @param $data
     * @param SysEntityUser|null $entityUser
     * @return mixed
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function insertOrUpdate($data, SysEntityUser &$entityUser = null)
    {
        if(!is_object($entityUser)){
            $entityUser = new SysEntityUser();
        }
        $entityUser->fromArray($data);
        $results['success'] = $entityUser->validate();
        if ($results['success']) {
            $entityUser->save();
        }
        $results['object'] = $entityUser;
        $results['errors'] = $entityUser->getErrorsMap();
        return $results;
    }

}