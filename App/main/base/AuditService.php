<?php

/**
 *
 * @author: ypra
 * Date: 1/24/2018
 * Time: 11:46 a.m.
 */
abstract class AuditService extends GenericService
{
    use Logging;

    public function _init()
    {
    }

    /**
     * @param $object
     */
    public function prepareInsert($object)
    {
        if (method_exists($object, 'setStatus')) {
            $object->setStatus(SoftDelete::ACTIVE);
        }
        if (method_exists($object, 'setLastUserId')) {
            $object->setLastUserId(UserControl::isLoggedIn() ? UserControl::user()->getId() : 0);
        }
        if (method_exists($object, 'setCreationDate')) {
            $object->setCreationDate(new DateTime());
        }
        if (method_exists($object, 'setModificationDate')) {
            $object->setModificationDate(new DateTime());
        }
    }

    /**
     * @param $object
     */
    public function prepareUpdate($object)
    {
        if (method_exists($object, 'setLastUserId')) {
            $object->setLastUserId(UserControl::isLoggedIn() ? UserControl::user()->getId() : 0);
        }
        if (method_exists($object, 'setModificationDate')) {
            $object->setModificationDate(new DateTime());
        }
    }

    /**
     * @param $object
     */
    public function prepareDelete($object)
    {
        if (method_exists($object, 'setStatus')) {
            $object->setStatus(SoftDelete::DELETED);
        }
        if (method_exists($object, 'setLastUserId')) {
            $object->setLastUserId(UserControl::isLoggedIn() ? UserControl::user()->getId() : 0);
        }
    }

    /**
     * @param $data
     * @param null $object
     * @param null $connection
     * @return mixed | array
     */
    public function insertOrUpdate($data, &$object = null, $connection = null)
    {
        if(is_object($object)){
            $this->prepareUpdate($object);
        }else{
            $object = new static::$_entityClass();
            $this->prepareInsert($object);
        }
        $object->fromArray($data);
        $results['success'] = $object->validate();
        if ($results['success']) {
            $object->save($connection);
        }
        $results['object'] = $object;
        $results['errors'] = $object->getErrorsMap();
        return $results;
    }

    /**
     * @param $object
     * @return int
     */
    public function delete($object, $connection)
    {
        if (method_exists($object, "setStatus")) {
            $this->prepareDelete($object);
            return $object->save($connection);
        }
        return 0;
    }

}