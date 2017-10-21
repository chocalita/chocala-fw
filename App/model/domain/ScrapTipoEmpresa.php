<?php

use Base\ScrapTipoEmpresa as BaseScrapTipoEmpresa;

/**
 *
 */
class ScrapTipoEmpresa extends BaseScrapTipoEmpresa implements JsonSerializable
{
    use  Validatable, Convertible;

}
