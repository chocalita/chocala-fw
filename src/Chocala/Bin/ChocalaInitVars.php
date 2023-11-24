<?php

namespace Chocala\Bin;

use Chocala\Configuration\Config;
use Chocala\System\DBConfig;
use Chocala\System\Session;

/**
 * Description of ChocalaInitVars
 *
 * @author ypra
 */
abstract class ChocalaInitVars
{

    /**
     * Is a token for verify the initialization of framework parameters
     * @var boolean
     */
    private static $frameworkInitialized = false;

    /**
     * Is a token for verify the initialization of application constants
     * @var boolean
     */
    private static $applicationInitialized = false;

    /**
     * Init the global parameters (path directories) and include the main
     * classes for use in the system
     * @return void
     */
    public static function frameworkInit()
    {
        if (!self::$frameworkInitialized) {
            // Framework directories
            define('SYSTEM_DIR', CHOCALA_DIR);
            define('BIN_DIR', CHOCALA_DIR . 'Bin' . DIRECTORY_SEPARATOR);

            define('LIB_DIR', CHOCALA_DIR . 'Lib' . DIRECTORY_SEPARATOR);
            define('ALIAS_DIR', CHOCALA_DIR . 'Alias' . DIRECTORY_SEPARATOR);

            // Framework directories
            define('CONFIGS_DIR', APP_DIR . 'configs' . DIRECTORY_SEPARATOR);
            define('I18N_DIR', APP_DIR . 'i18n' . DIRECTORY_SEPARATOR);
            define('MAIN_DIR', APP_DIR . 'main' . DIRECTORY_SEPARATOR);
            define('MODEL_DIR', APP_DIR . 'model' . DIRECTORY_SEPARATOR);
            define('MODULES_DIR', APP_DIR . 'modules' . DIRECTORY_SEPARATOR);
            define('BASE_DIR', MAIN_DIR . 'base' . DIRECTORY_SEPARATOR);
            define('CONTENT_DIR', MAIN_DIR . 'content' . DIRECTORY_SEPARATOR);
            define('MAPPING_DIR', CONFIGS_DIR . 'mapping' . DIRECTORY_SEPARATOR);
            define('DATABASE_DIR', MODEL_DIR . 'database' . DIRECTORY_SEPARATOR);
            define('DOMAIN_DIR', MODEL_DIR . 'domain' . DIRECTORY_SEPARATOR);

            define('LAYOUTS_DIR', CONTENT_DIR . 'layouts' . DIRECTORY_SEPARATOR);
            define('BARS_DIR', CONTENT_DIR . 'bars' . DIRECTORY_SEPARATOR);
            define('EMAILS_DIR', CONTENT_DIR . 'emails' . DIRECTORY_SEPARATOR);

            define('TEMPLATES_DIR', CONTENT_DIR . 'templates' . DIRECTORY_SEPARATOR);
            define('RTC_DIR', CONTENT_DIR . 'rtcContents' . DIRECTORY_SEPARATOR);

            // Resources directories (public access)
            define('PUBLIC_DIR', APP_DIR . 'public' . DIRECTORY_SEPARATOR);
            define('IMG_DIR', PUBLIC_DIR . 'images' . DIRECTORY_SEPARATOR);
            define('FILES_DIR', PUBLIC_DIR . 'files' . DIRECTORY_SEPARATOR);

            // URL paths for public Web access
            define('WEB_ROOT',
//                (isset($_SERVER['REQUEST_SCHEME']) ? $_SERVER['REQUEST_SCHEME'] : "https") .
//                '://' . $_SERVER['HTTP_HOST'] .
                'http://' . $_SERVER['HTTP_HOST'] .
                ($_SERVER['SCRIPT_NAME'] != '' ?
                    (str_replace('index.php', '', $_SERVER['SCRIPT_NAME'])) :
                    '/'));

            // URL resources
            define('FONTS_WEB', WEB_ROOT . 'fonts/');
            define('CSS_WEB', WEB_ROOT . 'css/');
            define('JS_WEB', WEB_ROOT . 'js/');
            define('IMG_WEB', WEB_ROOT . 'images/');
            define('FILES_WEB', WEB_ROOT . 'files/');
            define('LIBS_WEB', WEB_ROOT . 'libs/');

            define('JQUERY_WEB', JS_WEB . 'jquery/');

            define('ICONS_WEB', IMG_WEB . 'icons/');
            define('ICO_16', ICONS_WEB . '16/');
            define('ICO_24', ICONS_WEB . '24/');
            define('ICO_32', ICONS_WEB . '32/');
            define('ICO_64', ICONS_WEB . '64/');
            define('ICO_128', ICONS_WEB . '128/');
            define('ICO_256', ICONS_WEB . '256/');

            // Autoloadings
            //Comentado porque se importa en la inicializacion de las constantes globales (VENDOR_DIR)
//            require_once(VENDOR_DIR . 'autoload.php');
            require_once('ChocalaAutoload.php');

            self::$frameworkInitialized = true;
        }
    }

    public static function applicationInit()
    {
        if (!self::$applicationInitialized) {
            date_default_timezone_set(Config::_('app.default.timezone'));
            DBConfig::init();
//            require_once(DATABASE_DIR.'generator/config.php');
            try {
//                set_include_path(BASE_DIR.PATH_SEPARATOR.get_include_path());
//                set_include_path(DOMAIN_DIR.PATH_SEPARATOR.get_include_path());
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
            //TODO: Apply an App Session customized settings (session id, session name)
            //session_start();
            Session::instance();
            //TODO: Apply an App i18n customized settings (i18n dynamic)
            self::$applicationInitialized = true;
        }
    }

}