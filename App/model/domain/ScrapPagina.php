<?php

use Base\ScrapPagina as BaseScrapPagina;

/**
 *
 * @author ypra
 */
class ScrapPagina extends BaseScrapPagina implements JsonSerializable
{
    use  Validatable, Convertible;

    public function empresasNoLeidas()
    {
        return ScrapEmpresaQuery::createValids()
                ->filterByScrapPagina($this)
                ->filterByLeido(false)
                ->orderByNombre()
            ->find();
    }

}
