<?php

use \Propel\Runtime\Connection\ConnectionInterface as ConnectionInterface;

/**
 * @author ypra
 * Date: 25/9/2018
 * Time: 9:41 PM
 *
 * @method static EventUserService instance()
 */
class EventUserService extends AuditService
{

    /**
     * @var EventUserService
     */
    protected static $instance = null;

    /**
     * @return SysEventUserQuery
     */
    public function validsQuery()
    {
        return SysEventUserQuery::create();
    }

    /**
     * @param $pk
     * @return array|mixed|SysEventUser
     * @throws NotFoundException
     */
    public function findPk($pk)
    {
        $user = $this->validsQuery()->findPk($pk);
        if (!is_object($user)) {
            throw new NotFoundException(ChocalaErrors::INVALID_RESOURCE);
        }
        return $user;
    }

    /**
     * @param array $filters
     * @return SysEventUser[]|\Propel\Runtime\Util\PropelModelPager
     */
    public function dataList($filters = [])
    {
        $filters['_order'] = isset($filters['_order'])? $filters['_order']: 'date';
        $filters['_sort'] = isset($filters['_sort'])? $filters['_sort']: 'asc';
        $query = $this->validsQuery()
            ->orderBy($filters['_order'], $filters['_sort']);
        $_page = $filters['_page'] ?: 1;
        $_max = $filters['_max'] ?: $query->count();
        return $query->paginate($_page, $_max);
    }

    /**
     * @param $data
     * @param SysEventUser|null $eventUser
     * @return mixed
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function insertOrUpdate($data, SysEventUser &$eventUser = null, ConnectionInterface $con = null)
    {
        if(!is_object($eventUser)){
            $eventUser = new SysEventUser();
        }
        $eventUser->fromArray($data);
        $results['success'] = $eventUser->validate();
        if ($results['success']) {
            $eventUser->save($con);
        }
        $results['object'] = $eventUser;
        $results['errors'] = $eventUser->getErrorsMap();
        return $results;
    }


}