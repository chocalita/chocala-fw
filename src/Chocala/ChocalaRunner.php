<?php

namespace Chocala;

/**
 * Description of ChocalaRunner
 *
 * @author ypra
 */
abstract class ChocalaRunner
{
    public static function run()
    {
        \Chocala\Bin\ChocalaInitVars::frameworkInit();
        \Chocala\Configuration\ConfigLoader::loadConfigsOld();
        \Chocala\Bin\ChocalaInitVars::applicationInit();
        \Chocala\I18N\DefaultTranslation::mainInstance();
        \Chocala\System\Flash::initialize();
        \Chocala\Base\FrontController::instance()->route();
    }
}
