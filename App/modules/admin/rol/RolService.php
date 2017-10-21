<?php

/**
 * Class RolService
 *
 */
class RolService extends GenericService
{

    /**
     * @var RolService
     */
    protected static $instance = null;

    /**
     * @param bool|true $noDeletes
     * @return SysRolQuery
     */
    public function validsQuery($noDeletes=true)
    {
        return SysRolQuery::createValids($noDeletes);
    }

    /**
     * @param $pk
     * @return array|mixed|SysRol
     * @throws ChocalaException
     */
    public function findPk($pk)
    {
        $rol = $this->validsQuery()->findPk($pk);
        if (!is_object($rol)) {
            throw new ChocalaException(ChocalaErrors::INVALID_RESOURCE);
        }
        return $rol;
    }

    /**
     * @param array $filters
     * @return SysRol[]|\Propel\Runtime\Util\PropelModelPager
     */
    public function dataList($filters=[])
    {
        $query = $this->validsQuery()
            ->_if(isset($filters['code']))
                ->filterByCode('%'.$filters['code'].'%', Criteria::ILIKE)
            ->_endif()
            ->_if(isset($filters['name']))
                ->filterByName('%'.$filters['name'].'%', Criteria::ILIKE)
            ->_endif()
            ->orderByName()
        ;
        $_page = $filters['_page']?: 1;
        $_max = $filters['_max']?: $query->count();
        return $query->paginate($_page, $_max);
    }

    /**
     * @param array $data
     * @param SysRol|null $rol
     * @return array|mixed
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function insertOrUpdate($data, &$rol = null)
    {
        if(!is_object($rol)){
            $rol = new SysRol();
        }
        $rol->fromArray($data);
        $results['success'] = $rol->validate();
        if ($results['success']) {
            $rol->save();
        }
        $results['object'] = $rol;
        $results['errors'] = $rol->getErrorsMap();
        return $results;
    }

    /**
     * @param string $code
     * @param bool|true $noDeletes
     * @return SysRol
     */
    public function withCode($code, $noDeletes=true)
    {
        return $this->validsQuery($noDeletes)->findOneByCode($code);
    }

}