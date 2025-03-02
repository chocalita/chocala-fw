<?php

use Base\SysParamQuery as BaseSysParamQuery;

/**
 *
 * @author ypra
 *
 * @method static SysParamQuery createValids($noDeletes = true, $modelAlias = null, Criteria $criteria = null)
 * @method SysParamQuery filterValids()
 */
class SysParamQuery extends BaseSysParamQuery //implements SoftDeletion
{
    use SoftQuery;

    /**
     * @param string $visibility
     * @param bool|null $customizables
     * @param bool $noDeletes
     * @return $this|\Propel\Runtime\ActiveQuery\Criteria
     */
    public static function createForVisibility(string $visibility, bool $customizables=null, bool $noDeletes=true)
    {
        return self::createValids($noDeletes)
            ->filterByVisibility($visibility)
            ->_if($customizables !== null)
                ->filterByCustomizable($customizables)
            ->_endif();
    }

    /**
     * @param bool $noDeletes
     * @return $this|\Propel\Runtime\ActiveQuery\Criteria|SysParamQuery
     */
    public static function createForGlobal(bool $noDeletes=true)
    {
        return self::createForVisibility(SysParam::VISIBILITY_GLOBAL, null, $noDeletes);
    }

    /**
     * @param bool|null $customizables
     * @param bool $noDeletes
     * @return $this|\Propel\Runtime\ActiveQuery\Criteria|SysParamQuery
     */
    public static function createForEntities(bool $customizables=null, bool $noDeletes=true)
    {
        return self::createForVisibility(SysParam::VISIBILITY_ENTITY, $customizables, $noDeletes);
    }

    /**
     * @param bool|null $customizables
     * @param bool $noDeletes
     * @return $this|\Propel\Runtime\ActiveQuery\Criteria|SysParamQuery
     */
    public static function createForUsers(bool $customizables=null, bool $noDeletes=true)
    {
        return self::createForVisibility(SysParam::VISIBILITY_USER, $customizables, $noDeletes);
    }

}