
require_once "internal.php";

$_REQUEST['url'] == 'recursos/paginaDirectorio/testCron';
require_once(CHOCALA_DIR.'ChocalaRunner.php');
ChocalaRunner::run();
