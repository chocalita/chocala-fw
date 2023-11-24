<?php
require_once "Bin/ChocalaInitVars.php";

/**
 * Description of ChocalaRunner
 *
 * @author ypra
 */
// Temporal class to organize in non request framework calls
abstract class ChocalaRunner2
{

    public static function run()
    {

        ChocalaInitVars::frameworkInit();
        ConfigLoader::loadConfigs();
        ChocalaInitVars::applicationInit();
        ChocalaI18N::mainInstance();
        Flash::initialize();
        file_put_contents(APP_DIR . "running.txt", "yecid " . date("H:i:s"));
//        try {
//        $p = new PaginaDirectorioController();
//        $p->testCron();

            FrontController::instance()->route();
//        } catch (Exception $eyy) {
//            file_put_contents(APP_DIR . "myerror.txt", "yecid " . $eyy->getMessage());
//        }
        file_put_contents(APP_DIR . "runed.txt", "yecid " . date("H:i:s"));
    }

}