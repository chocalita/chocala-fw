<?php
require_once "internal.php";

//if($_REQUEST['url'] == ''){
//    header('HTTP/1.1 301 Moved Permanently');
//    header('Location: index.htm');
//    exit();
//}

$_REQUEST['url'] = 'recursos/paginaDirectorio/testCron';
require_once(CHOCALA_DIR.'ChocalaRunner.php');
ChocalaRunner::run();

?>