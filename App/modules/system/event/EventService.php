<?php

/**
 * @author ypra
 * Date: 25/9/2018
 * Time: 9:41 PM
 *
 * @method static EventService instance()
 */
class EventService extends AuditService
{

    /**
     * @var EventService
     */
    protected static $instance = null;

    /**
     * @return SysEventQuery
     */
    public function validsQuery()
    {
        return SysEventQuery::create();
    }

    /**
     * @param $pk
     * @return array|mixed|SysEvent
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
     * @param $code
     * @return SysEvent
     */
    public function findOneByCode($code)
    {
        return $this->validsQuery()
            ->filterByCode($code)
            ->findOne();
    }

    /**
     * @param array $filters
     * @return SysEvent[]|\Propel\Runtime\Util\PropelModelPager
     */
    public function dataList($filters = [])
    {
        $filters['_order'] = isset($filters['_order']) ? $filters['_order'] : 'name';
        $query = $this->validsQuery()
            ->_if(isset($filters['code']))
            ->filterByCode('%' . $filters['code'] . '%', Criteria::ILIKE)
            ->_endif()
            ->_if(isset($filters['name']))
            ->filterByName('%' . $filters['name'] . '%', Criteria::ILIKE)
            ->_endif()
            ->_if(isset($filters['type']))
            ->filterByType($filters['type'])
            ->_endif()
            ->_if(isset($filters['level']))
            ->filterByLevel($filters['level'])
            ->_endif()
            ->orderBy($filters['_order']);
        $_page = $filters['_page'] ?: 1;
        $_max = $filters['_max'] ?: $query->count();
        return $query->paginate($_page, $_max);
    }

    /**
     * @param $data
     * @param SysEvent|null $event
     * @param null $connection
     * @return mixed
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function insertOrUpdate($data, SysEvent &$event = null, $connection = null)
    {
        if (!is_object($event)) {
            $event = new SysEvent();
        }
        $event->fromArray($data);
        $results['success'] = $event->validate();
        if ($results['success']) {
            $event->save();
        }
        $results['object'] = $event;
        $results['errors'] = $event->getErrorsMap();
        return $results;
    }

    public function types()
    {
        // TODO: filters by user/rol
        return SysEvent::$types;
    }

    public function levels()
    {
        // TODO: filters by user/rol
        return SysEvent::$levels;
    }

}