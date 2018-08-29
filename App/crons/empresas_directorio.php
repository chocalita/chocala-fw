<?php
require_once "internal.php";

//if($_REQUEST['url'] == ''){
//    header('HTTP/1.1 301 Moved Permanently');
//    header('Location: index.htm');
//    exit();
//}
file_put_contents(APP_DIR . "first.txt", "yecid " . date("H:i:s"));
//print_r($_SERVER); exit();
try {

    $_SERVER['HTTP_HOST'] = 'www.empleos.click';
    $_SERVER['SCRIPT_NAME'] = '';

/*
define('WEB_ROOT',
    (isset($_SERVER['REQUEST_SCHEME']) ? $_SERVER['REQUEST_SCHEME'] : "https") .
    '://' . $_SERVER['HTTP_HOST'] .
//                'http://' . $_SERVER['HTTP_HOST'] .
    ($_SERVER['SCRIPT_NAME'] != '' ?
        (str_replace('index.php', '', $_SERVER['SCRIPT_NAME'])) :
        '/'));
*/

    $_REQUEST['url'] = 'recursos/paginaDirectorio/testCron';
    require_once(CHOCALA_DIR.'ChocalaRunner.php');
    ChocalaRunner::run();
} catch (Exception $e) {
    file_put_contents(APP_DIR . "first.txt", "ERROR " . $e->getMessage() ." " . date("H:i:s"));
}


?>