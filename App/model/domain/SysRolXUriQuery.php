<?php

use Base\SysRolXUriQuery as BaseSysRolXUriQuery;

/**
 *
 * @author ypra
 *
 * @method static SysRolXUriQuery createValids($noDeletes = true, $modelAlias = null, Criteria $criteria = null)
 * @method SysRolXUriQuery filterValids()
 */
class SysRolXUriQuery extends BaseSysRolXUriQuery //implements SoftDeletion
{
    use SoftQuery;

    /**
     * @param SysRol $uri
     * @param bool|true $noDeletes
     * @return \Propel\Runtime\Collection\ObjectCollection|SysRolXUri[]
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public static function findByRol(SysRol $uri, $noDeletes=true)
    {
        return self::createValids($noDeletes)
                ->filterBySysRol($uri)
            ->find();
    }

    /**
     * @param SysUri $uri
     * @param bool|true $noDeletes
     * @return \Propel\Runtime\Collection\ObjectCollection|SysRolXUri[]
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public static function findByUri(SysUri $uri, $noDeletes=true)
    {
        return self::createValids($noDeletes)
                ->filterBySysUri($uri)
            ->find();
    }

}