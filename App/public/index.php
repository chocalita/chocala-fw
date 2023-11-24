<?php

use Chocala\Base\IllegalStateException;
use Chocala\I18N\DefaultTranslation;

error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED & ~E_WARNING);

ini_set('memory_limit', '512M');

$rootDir = '';

$applicationDir = 'App';

$frameworkDir = 'src/Chocala';

$vendorDir = 'Vendor';

if(!is_dir($rootDir)){
    $rootDir = realpath(dirname(dirname(dirname(__FILE__)))).
        DIRECTORY_SEPARATOR;
}

if(!is_dir($applicationDir)){
    $applicationDir = $rootDir.$applicationDir.DIRECTORY_SEPARATOR;
}

if(!is_dir($frameworkDir)){
    $frameworkDir = $rootDir.$frameworkDir.DIRECTORY_SEPARATOR;
}

if(!is_dir($vendorDir)){
    $vendorDir = $rootDir.$vendorDir.DIRECTORY_SEPARATOR;
}

if(!defined('ROOT')){
    define('ROOT', $rootDir);
}
if(!defined('APP_DIR')){
    define('APP_DIR', $applicationDir);
}
if(!defined('CHOCALA_DIR')){
    define('CHOCALA_DIR', $frameworkDir);
}
if(!defined('VENDOR_DIR')){
    define('VENDOR_DIR', $vendorDir);
}

if(!defined('PY_NAME')){
    $parts = explode(DIRECTORY_SEPARATOR, ROOT);
    define('PY_NAME', $parts[sizeof($parts)-2]);
}

if(!defined('APP_DIR_NAME')){
    $parts = explode(DIRECTORY_SEPARATOR, APP_DIR);
    define('APP_DIR_NAME', $parts[sizeof($parts)-2]);
}

if(!defined('CHOCALA_DIR_NAME')){
    $parts = explode(DIRECTORY_SEPARATOR, CHOCALA_DIR);
    define('CHOCALA_DIR_NAME', $parts[sizeof($parts)-2]);
}

if(!defined('VENDOR_DIR_NAME')){
    $parts = explode(DIRECTORY_SEPARATOR, VENDOR_DIR);
    define('VENDOR_DIR_NAME', $parts[sizeof($parts)-2]);
}

unset($rootDir, $applicationDir, $frameworkDir, $vendorDir, $parts);

//TODO: Verify if this redirect is correct
if($_REQUEST['url'] == ''){
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: index.htm');
    exit();
}

require_once(VENDOR_DIR . 'autoload.php');

if (!function_exists('__()')) {
    function __(string $text, array $args = [])
    {
        return DefaultTranslation::mainInstance()->translate($text, $args);
    }
} else {
    throw new IllegalStateException('It\'s not possible to register \'__()\' translation function.');
}
\Chocala\ChocalaRunner::run();