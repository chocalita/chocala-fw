<?php

namespace App\model\security;

/**
 * Description of PageConfigs
 *
 * @author ypra
 */
class PageConfigs
{
    
    const ACCESS_PRIVATE = "PRIVATE";

    const ACCESS_PROTECTED = "PROTECTED";

    const ACCESS_PUBLIC = "PUBLIC";

    const NO_PAGE = 'noAction';

    const NO_PAGE_TITLE = 'Direccion no encontrada';

    const TYPE_MENU = "MENU";

    const TYPE_SECTION = "SECTION";

    public static function enumAccess()
    {
        $pageAccess = array(
            PageConfigs::ACCESS_PRIVATE => PageConfigs::ACCESS_PRIVATE,
            PageConfigs::ACCESS_PROTECTED => PageConfigs::ACCESS_PROTECTED,
            PageConfigs::ACCESS_PUBLIC => PageConfigs::ACCESS_PUBLIC);
        return $pageAccess;
    }

    public static function enumTypes()
    {
        $pageTypes = array(
            PageConfigs::TYPE_MENU => PageConfigs::TYPE_MENU,
            PageConfigs::TYPE_SECTION => PageConfigs::TYPE_SECTION);
        return $pageTypes;
    }

}