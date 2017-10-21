<?php

use Base\ScrapPaginaQuery as BaseScrapPaginaQuery;

/**
 *
 * @author ypra
 *
 * @method static ScrapPaginaQuery createValids($noDeletes = true, $modelAlias = null, Criteria $criteria = null)
 * @method ScrapPaginaQuery filterValids()
 */
class ScrapPaginaQuery extends BaseScrapPaginaQuery
{
    use SoftQuery;

}
