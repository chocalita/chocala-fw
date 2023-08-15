<?php

use Base\SysEntityParamQuery as BaseSysEntityParamQuery;

/**
 *
 * @author ypra
 *
 * @method static SysEntityParamQuery createValids($noDeletes = true, $modelAlias = null, Criteria $criteria = null)
 * @method SysEntityParamQuery filterValids()
 */
class SysEntityParamQuery extends BaseSysEntityParamQuery //implements SoftDeletion
{
    use SoftQuery;

    /**
     * @param SysEntity $entity
     * @param bool $noDeletes
     * @return SysEntityParamQuery
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public static function createForEntity(SysEntity $entity, bool $noDeletes=true): SysEntityParamQuery
    {
        return self::createValids($noDeletes)
            ->filterBySysEntity($entity)
            ->useSysParamQuery()
                ->orderByName()
            ->endUse();
    }

}