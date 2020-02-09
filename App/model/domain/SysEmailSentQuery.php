<?php

use Base\SysEmailSentQuery as BaseSysEmailSentQuery;

/**
 * @author ypra
 *
 * @method static SysEmailSentQuery createValids($noDeletes = true, $modelAlias = null, Criteria $criteria = null)
 * @method SysEmailSentQuery filterValids()
 */
class SysEmailSentQuery extends BaseSysEmailSentQuery
{
    use SoftQuery;




}