<?php

use Base\TmpFormacionQuery as BaseTmpFormacionQuery;

/**
 * @author ypra
 *
 * @method static TmpAreaQuery createValids($noDeletes = true, $modelAlias = null, Criteria $criteria = null)
 * @method TmpAreaQuery filterValids()
 *
 */
class TmpFormacionQuery extends BaseTmpFormacionQuery //implements SoftDeletion
{
    use SoftQuery;

    public static function data()
    {
        return self::create()->orderByName();
    }

}