<?php
require_once "Bin/ChocalaInitVars.php";

/**
 * Description of ChocalaRunner
 *
 * @author ypra
 */
abstract class ChocalaRunner
{

    public static function run()
    {
        ChocalaInitVars::frameworkInit();
        ConfigLoader::loadConfigs();
        ChocalaInitVars::applicationInit();
        ChocalaI18N::mainInstance();
        Flash::initialize();
        FrontController::instance()->route();
    }

}