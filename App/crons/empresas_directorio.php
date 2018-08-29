<?php
require_once "internal.php";

//if($_REQUEST['url'] == ''){
//    header('HTTP/1.1 301 Moved Permanently');
//    header('Location: index.htm');
//    exit();
//}
file_put_contents(APP_DIR . "first.txt", "yecid");

$_REQUEST['url'] = 'recursos/paginaDirectorio/testCron';
require_once(CHOCALA_DIR.'ChocalaRunner.php');
ChocalaRunner::run();

?>