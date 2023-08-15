<?php

use Base\SysEntityBranchQuery as BaseSysEntityBranchQuery;

/**
 * @author ypra
 *
 *
 * @method static SysEntityBranchQuery createValids($noDeletes = true, $modelAlias = null, Criteria $criteria = null)
 * @method SysEntityBranchQuery filterValids()
 */
class SysEntityBranchQuery extends BaseSysEntityBranchQuery implements SoftDeletion
{
    use SoftQuery;

    /**
     * @param SysEntity $entity
     * @return array|mixed|SysEntityBranch
     */
    public static function findMainBranch(SysEntity $entity)
    {
        return self::createValids()->findPk($entity->getMainBranchId());
    }

    /**
     * @param SysEntity $entity
     * @param bool $noDeletes
     * @return mixed
     */
    public static function findByEntity(SysEntity $entity, bool $noDeletes=true)
    {
        return self::createValids($noDeletes)
                ->filterBySysEntity($entity)
                ->orderByName()
            ->find();
    }

}