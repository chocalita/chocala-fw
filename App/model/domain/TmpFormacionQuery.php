<?php

use Base\TmpFormacionQuery as BaseTmpFormacionQuery;

/**
 * @author ypra
 *
 * @method static TmpFormacionQuery createValids($noDeletes = true, $modelAlias = null, Criteria $criteria = null)
 * @method TmpFormacionQuery filterValids()
 *
 */
class TmpFormacionQuery extends BaseTmpFormacionQuery //implements SoftDeletion
{
    use SoftQuery;

}