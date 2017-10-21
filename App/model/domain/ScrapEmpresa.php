<?php

use Base\ScrapEmpresa as BaseScrapEmpresa;

/**
 *
 */
class ScrapEmpresa extends BaseScrapEmpresa implements JsonSerializable
{
    use  Validatable, Convertible;

}
