<?php
/**
 *
 * @author ypra
 * Date: 1/23/2016
 * Time: 6:13 a.m.
 */
abstract class GenericService extends ChocalaSingleService
{

    public function _init()
    {
    }

    /**
     * @param $status
     * @return string
     */
    public function status($status)
    {
        $array = static::statusMap();
        return $array[$status];
    }

    /**
     * @param $object
     * @return mixed
     * @throws ChocalaException
     */
    protected function verifyObject($object)
    {
        if(!is_object($object)){
            throw new ChocalaException ("Invalid Object");
        }
        return $object;
    }

    /**
     * @param $object
     * @return mixed
     */
    public function prepareInsert($object)
    {
        if(method_exists($object, 'setStatus')){
            $object->setStatus(SoftDelete::ACTIVE);
        }
        if(method_exists($object, 'setLastUserId')){
            $object->setLastUserId(UserControl::isLoggedIn()? UserControl::user()->getId(): 0);
        }
        if(method_exists($object, 'setCreationDate')){
            $object->setCreationDate(new DateTime());
        }
        return $object;
    }

    /**
     * @param $object
     * @return mixed
     */
    public function prepareUpdate($object)
    {
        if(method_exists($object, 'setLastUserId')){
            $object->setLastUserId(UserControl::isLoggedIn()? UserControl::user()->getId(): 0);
        }
        if(method_exists($object, 'setModificationDate')){
            $object->setModificationDate(date('Y-m-d'));
        }
        return $object;
    }

    /**
     * @param $object
     * @return mixed
     */
    public function prepareDelete($object)
    {
        if(method_exists($object, 'setStatus')){
            $object->setStatus(SoftDelete::DELETED);
        }
        if(method_exists($object, 'setLastUserId')){
            $object->setLastUserId(UserControl::isLoggedIn()? UserControl::user()->getId(): 0);
        }
        return $object;
    }

    /**
     * @param $object
     * @return int
     */
    public function delete($object)
    {
        if (method_exists($object, "setStatus")) {
            return $this->prepareDelete($object)->save();
        }
        return 0;
    }

}