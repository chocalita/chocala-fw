<?php

/**
 *
 * @author ypra
 * Date: 11/2/2016
 * Time: 4:50 PM
 */
class UriService extends GenericService
{

    /**
     * @var UriService
     */
    protected static $instance = null;

    /**
     * @return SysUriQuery
     */
    public function validsQuery()
    {
        return SysUriQuery::createValids();
    }

    /**
     * @param $pk
     * @return array|mixed|SysUri
     * @throws NotFoundException
     */
    public function findPk($pk)
    {
        $uri = $this->validsQuery()->findPk($pk);
        if (!is_object($uri)) {
            throw new NotFoundException(ChocalaErrors::INVALID_RESOURCE);
        }
        return $uri;
    }

    /**
     * @param array $filters
     * @return SysUri[]|\Propel\Runtime\Util\PropelModelPager
     */
    public function dataList($filters=[])
    {
        $query = $this->validsQuery()
            ->_if(isset($filters['moduloId']))
                ->filterByModuleId($filters['moduloId'])
            ->_endif()
            ->_if(isset($filters['uri']))
                ->filterByUri('%'.$filters['uri'].'%', Criteria::ILIKE)
            ->_endif()
            ->_if(isset($filters['title']))
                ->filterByTitle('%'.$filters['title'].'%', Criteria::ILIKE)
            ->_endif()
            ->_if(isset($filters['access']))
                ->filterByAccess($filters['access'])
            ->_endif()
            ->_if(isset($filters['type']))
                ->filterByType($filters['type'])
            ->_endif()
            ->orderByPosition()
        ;
        $_page = $filters['_page']?: 1;
        $_max = $filters['_max']?: $query->count();
        return $query->paginate($_page, $_max);
    }

    /**
     * @param array $data
     * @param SysUri|null $uri
     * @return array|mixed
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function insertOrUpdate($data, SysUri &$uri = null)
    {
        if(!is_object($uri)){
            $uri = new SysUri();
        }
        $uri->fromArray($data);
        $this->positionate($uri);
        $results['success'] = $uri->validate();
        if ($results['success']) {
            $uri->save();
        }
        $results['object'] = $uri;
        $results['errors'] = $uri->getErrorsMap();
        return $results;
    }

    /**
     * @param SysUri $uri
     * @param int $position
     */
    public function positionate(SysUri $uri, $position = 0)
    {
        if($uri->isNew()){
            $uri->setPosition($uri->getSysModule()->countSysUris()+1);
        }elseif($position > 0){
            $uri->setPosition($position);
        }
    }

    /**
     * @param int $rolId
     * @param int $uriId
     * @param bool|true $strict
     * @return array|mixed|SysRolXUri
     * @throws ChocalaException
     */
    public function findRolUri($rolId, $uriId, $strict = true)
    {
        $rolXUri = SysRolXUriQuery::createValids()->findPk([$rolId, $uriId]);
        if ($strict && !is_object($rolXUri)) {
            throw new ChocalaException(ChocalaErrors::INVALID_RESOURCE);
        }
        return $rolXUri;
    }

    /**
     * @param int $rolId
     * @param int $uriId
     * @return bool
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function changeMainPermission($rolId, $uriId)
    {
        $rolUri = $this->findRolUri($rolId, $uriId, false);
        if($rolUri) {
            $rolUri->delete();
            return false;
        } else {
            $rolUri = new SysRolXUri();
            $rolUri->setRolId($rolId);
            $rolUri->setUriId($uriId);
            $rolUri->save();
            return true;
        }
    }

    /**
     * @param $type
     * @param $rolId
     * @param $uriId
     * @return bool
     * @throws ChocalaException
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function changePermissionType($type, $rolId, $uriId)
    {
        $rolUri = $this->findRolUri($rolId, $uriId, false);
        $permission = false;
        if($rolUri) {
            switch ($type){
                case 'read';
                    $rolUri->setAutRead(!$rolUri->getAutRead());
                    $permission = $rolUri->getAutRead();
                    break;
                case 'create';
                    $rolUri->setAutCreate(!$rolUri->getAutCreate());
                    $permission = $rolUri->getAutCreate();
                    break;
                case 'update';
                    $rolUri->setAutUpdate(!$rolUri->getAutUpdate());
                    $permission = $rolUri->getAutUpdate();
                    break;
                case 'delete';
                    $rolUri->setAutDelete(!$rolUri->getAutDelete());
                    $permission = $rolUri->getAutDelete();
                    break;
            }
            $rolUri->save();
        }
        return $permission;
    }

}