<?php

$rootDir = '';

$applicationDir = 'App';

$frameworkDir = 'Chocala';

$vendorDir = 'Vendor';

if(!is_dir($rootDir)){
    $rootDir = realpath(dirname(dirname(dirname(__FILE__)))).
        DIRECTORY_SEPARATOR;
}

file_put_contents(dirname(__FILE__).DIRECTORY_SEPARATOR."prueba.txt", "yecid");

exit();

require_once "internal.php";

//if($_REQUEST['url'] == ''){
//    header('HTTP/1.1 301 Moved Permanently');
//    header('Location: index.htm');
//    exit();
//}

$_REQUEST['url'] = 'recursos/paginaDirectorio/testCron';
require_once(CHOCALA_DIR.'ChocalaRunner.php');


//ChocalaRunner::run();
?>