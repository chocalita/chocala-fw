<?php
/**
 *
 * @author ypra
 * Date: 11/2/2016
 * Time: 4:52 PM
 *
 */
class ModuleService extends GenericService
{

    /**
     * @var ModuleService
     */
    protected static $instance = null;

    /**
     * @return SysModuleQuery
     */
    public function validsQuery($noDeletes=true)
    {
        return SysModuleQuery::createValids($noDeletes);
    }

    /**
     * @param $pk
     * @return array|mixed|SysModule
     * @throws ChocalaException
     */
    public function findPk($pk)
    {
        $module = $this->validsQuery()->findPk($pk);
        if (!is_object($module)) {
            throw new ChocalaException(ChocalaErrors::INVALID_RESOURCE);
        }
        return $module;
    }

    /**
     * @param array $filters
     * @return SysModule[]|\Propel\Runtime\Util\PropelModelPager
     */
    public function dataList($filters=[])
    {
        $query = $this->validsQuery()
            ->_if(isset($filters['name']))
                ->filterByName('%'.$filters['name'].'%', Criteria::ILIKE)
            ->_endif()
            ->_if(isset($filters['uri']))
                ->filterByUri('%'.$filters['uri'].'%', Criteria::ILIKE)
            ->_endif()
            ->_if(isset($filters['access']))
                ->filterByAccess($filters['access'])
            ->_endif()
            ->orderByPosition()
        ;
        $_page = $filters['_page']?: 1;
        $_max = $filters['_max']?: $query->count();
        return $query->paginate($_page, $_max);
    }

    /**
     * @param array $data
     * @param SysModule|null $module
     * @return array|mixed
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function insertOrUpdate($data, SysModule &$module = null)
    {
        if(!is_object($module)){
            $module = new SysModule();
            $module->setPosition(sizeof($this->dataList()) + 1);
        }
        $module->fromArray($data);
        $results['success'] = $module->validate();
        if ($results['success']) {
            $module->save();
        }
        $results['object'] = $module;
        $results['errors'] = $module->getErrorsMap();
        return $results;
    }

}