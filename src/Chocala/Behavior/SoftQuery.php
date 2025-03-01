<?php

namespace Chocala\Behavior;

/**
 *
 * @author ypra
 * Date: 3/4/2016
 * Time: 11:52 p.m.
 */
trait SoftQuery
{
    public static function statusMap()
    {
        return SoftDelete::statusMap();
    }

    /**
     * @return array
     */
    public static function excludedStatus()
    {
        return [SoftDelete::DELETED];
    }

    /**
     * @return array
     */
    public static function validStatusMap()
    {
        return array_diff_key(static::statusMap(), array_flip(static::excludedStatus()));
//        $excludes = static::excludedStatus();
//        $status = static::statusMap();
//        return array_filter($status, function($k) use ($excludes){
//            return !in_array($k, $excludes);
//        }, ARRAY_FILTER_USE_KEY); // in php >= 5.6
    }

    /**
     * @return array
     */
    public static function validStatusList()
    {
        return array_keys(static::validStatusMap());
    }


    /**
     * @param null $modelAlias
     * @param Criteria|null $criteria
     * @return SoftDeletion
     */
    public static function createQuery($modelAlias = null, Criteria $criteria = null)
    {
        return static::create($modelAlias, $criteria);
    }

    /**
     * @return mixed
     */
    public function filterValids()
    {
        return method_exists($this, 'filterByStatus') ?
            $this->filterByStatus(static::validStatusList(), Criteria::IN) : $this;
    }

    /**
     * @param bool|true $noDeletes
     * @param null $modelAlias
     * @param Criteria|null $criteria
     * @return SoftDeletion|$this
     */
    public static function createValids($noDeletes = true, $modelAlias = null, Criteria $criteria = null)
    {
        $query = static::createQuery($modelAlias, $criteria);
        return ($noDeletes && ($query instanceof SoftDeletion)) ? $query->filterValids() : $query;
//        return $noDeletes? $query->filterValids(): $query;
    }

    /**
     * @param array $orderByArray
     * @return SoftDeletion
     */
    public function orders($orderByArray)
    {
        $query = $this;
        foreach ($orderByArray as $field => $order) {
            $query = $query->orderBy($field, static::resolveOrder($order));
        }
        return $query;
    }

    /**
     * @param $order
     * @return string
     */
    protected static function resolveOrder($order)
    {
        if (Validation::isInteger($order)) {
            return ($order * 1) == -1 ?: Criteria::ASC;
        } else {
            return strtoupper($order) == Criteria::DESC ? Criteria::DESC : Criteria::ASC;
        }
    }
}
