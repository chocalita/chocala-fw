<?php

use Base\TmpAreaQuery as BaseTmpAreaQuery;

/**
 * @author ypra
 *
 * @method static TmpAreaQuery createValids($noDeletes = true, $modelAlias = null, Criteria $criteria = null)
 * @method TmpAreaQuery filterValids()
 *
 */
class TmpAreaQuery extends BaseTmpAreaQuery //implements SoftDeletion
{
    use SoftQuery;

    public static function data()
    {
        return self::create()->orderByName();
    }

}