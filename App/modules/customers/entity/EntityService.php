<?php
/**
 * @author ypra
 * Date: 11/02/2015
 * Time: 10:19 PM
 *
 */
class EntityService extends GenericService
{

    /**
     * @var EntityService
     */
    protected static $instance = null;

    /**
     * @return SysEntityQuery
     */
    public function validsQuery($noDeletes=true)
    {
        return SysEntityQuery::createValids($noDeletes);
    }

    /**
     * @param $pk
     * @return array|mixed|SysEntity
     * @throws ChocalaException
     */
    public function findPk($pk)
    {
        $entity = $this->validsQuery()->findPk($pk);
        if (!is_object($entity)) {
            throw new ChocalaException(ChocalaErrors::INVALID_RESOURCE);
        }
        return $entity;
    }

    /**
     * @param array $filters
     * @return \Propel\Runtime\Util\PropelModelPager|SysEntity[]
     */
    public function dataList($filters=[])
    {
        $query = $this->validsQuery()
            ->_if(isset($filters['code']))
                ->filterByCode('%'.$filters['code'].'%', Criteria::ILIKE)
            ->_endif()
            ->_if(isset($filters['name']))
                ->filterByComercialName('%'.$filters['name'].'%', Criteria::ILIKE)
                ->_or()
                ->filterByFormalName('%'.$filters['name'].'%', Criteria::ILIKE)
            ->_endif()
            ->orderByComercialName()
        ;
        $_page = $filters['_page']?: 1;
        $_max = $filters['_max']?: $query->count();
        return $query->paginate($_page, $_max);
    }

    /**
     * @param array $data
     * @param SysEntity|null $entity
     * @return array mixed
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function insertOrUpdate($data, &$entity=null)
    {
        $entityBranch = null;
        if(!is_object($entity)){
            $entity = new SysEntity();
        }else{
            $entityBranch = $entity->mainBranch();
        }
        if(!is_object($entityBranch)){
            $entityBranch = new SysEntityBranch();
            $entityBranch->setName('Principal');
            $entity->addSysEntityBranch($entityBranch);
            $entityBranch->setSysEntity($entity);
        }
        $entity->fromArray($data);
        $entityBranch->fromArray($data);
        $results['success'] = $entity->validate() && $entityBranch->validate();
        if ($results['success']) {
            $entity->save();
            $entityBranch->save();
        }
        $results['object'] = $entity;
        $results['errors'] = array_merge($entity->getErrorsMap(), $entityBranch->getErrorsMap());
        return $results;
    }



    public static function logoFileExist($pkEntidad = ID_ENTITY){
        return file_exists(PUBLIC_DIR."images/imgEntidad/".$pkEntidad.".jpg");
    }

    public static function logoSrc($pkEntidad = ID_ENTITY){
        if(!self::logoFileExist($pkEntidad)){
            return IMG_WEB."imgEntidad/empresa_default.jpg";
        }else{
            return IMG_WEB."imgEntidad/".$pkEntidad.".jpg";
        }
    }

}