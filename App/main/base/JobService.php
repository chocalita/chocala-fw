<?php

/**
 *
 * @author: ypra
 * Date: 1/24/2016
 * Time: 11:46 a.m.
 */
abstract class JobService extends AppSecureService
{

    protected static $class;

    /**
     * @return ModelCriteria
     */
    public function validsQuery()
    {
        $queryClass = static::$class.'Query';
        return $queryClass::createValids();
    }

    /**
     * @param $data
     * @param $object
     * @return $object
     */
    public function insertOrUpdate($data, $object = null)
    {
        if(is_object($object)){
            $this->prepareUpdate($object);
        }else{
            $object = new static::$class();
            $this->prepareInsert($object);
        }
        $object->fromArray($data);
        $object->save();
        return $object;
    }

    public function genericFilters($query, $filters)
    {
        return $query
            ->_if(isset($filters['status']))
                ->filterByStatus($filters['status'])
            ->_endif()
            /**
             * TODO: implements filters CREATION AND MODIFICATION
            ->filterByCreationDate()
            ->filterByModificationDate()
            */
            ;
    }

}