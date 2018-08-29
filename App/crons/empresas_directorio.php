<?php
require_once "internal.php";

//if($_REQUEST['url'] == ''){
//    header('HTTP/1.1 301 Moved Permanently');
//    header('Location: index.htm');
//    exit();
//}
//try {
//$o = 0;
//$r = 0;
//$t = $o / $r;
    file_put_contents(APP_DIR . "first.txt", "yecid " . date("H:i:s"));

    $_SERVER['HTTP_HOST'] = 'www.empleos.click';
    $_SERVER['SCRIPT_NAME'] = '';
    $_SERVER['REQUEST_METHOD'] = 'GET';
    $_SERVER['SERVER_PROTOCOL'] = 'HTTP/1.1';
    $_GET['app'] = 'empleos.click';

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

    require_once(CHOCALA_DIR.'ChocalaRunner2.php');

    file_put_contents(APP_DIR . "second.txt", "yecid " . $_REQUEST['url']);

    ChocalaRunner2::run();

    file_put_contents(APP_DIR . "third.txt", "yecid " . date("H:i:s"));

//} catch (Exception $e) {
//    file_put_contents(APP_DIR . "error.txt", "ERROR " . $e->getMessage() ." " . date("H:i:s"));
//}


?>