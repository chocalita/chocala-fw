<?php
Chocala::import('Model.utils.simple_html_dom');
/**
 * Description of CronsController
 *
 * @author ypra
 */
class CronsController extends WebController
{

    /**
     * @var CronsService Injected service
     * @service CronsService
     */
    protected $cronsService;

    public function index()
    {
        $departamentos = $this->cronsService->departamentos();
        $resumenData = $this->cronsService->resumen();
        $this->set('departamentos', $departamentos);
        $this->set('resumenData', $resumenData);
    }

    public function readPages()
    {
        $depto = Req::_('Departamento');
        $tiempo = Req::_('Tiempo');
        $departamentos = $this->cronsService->departamentos();
        if(array_key_exists($depto, $departamentos)){
            $this->cronsService->leerDepartamentoTimeout($depto, $tiempo);
        }
        $this->redirectTo(['action' => 'index', 'params' => ['Departamento' => $depto]]);
    }

    public function test()
    {
//        $this->paginaDirectorioService->leerDepartamentoTimeout('02', 20);
        $empresa = ScrapEmpresaQuery::createValids()->findOneByIdEmpresa('3cf74613018208cb3a762093812095ae');
        $this->cronsService->scrapEmpresa($empresa);
        $this->render("FINALIZADO");
    }

    /**
     *
     */
    public function testCron()
    {
        $cronDirectory = APP_DIR . DIRECTORY_SEPARATOR . 'crons' . DIRECTORY_SEPARATOR;

        $cronFile = $cronDirectory . DIRECTORY_SEPARATOR . 'cron_results_' .date('yMdHis');

        $host = 'localhost';
        $db = 'directorio';
        $user = 'root';
        $pass = '';
        $charset = 'utf8';
        $dsn = "mysql:host=$host;port=3307;dbname=$db;charset=$charset";

        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
//            PDO::ATTR_CASE => PDO::CASE_UPPER
        ];

        try {
            $ids = ['0'];
            // TODO: fill ids array
            $statement = "SELECT * FROM empresa_directorio " .
                " WHERE TPS='SOCIEDAD DE RESPONSABILIDAD LIMITADA' " .
                " AND (MUNICIPIO='LA PAZ' OR MUNICIPIO='EL ALTO') AND ULT_RENOV > 2015 " .
                " AND ID NOT IN (" . implode(',', $ids). ",-1) " .
                " LIMIT 100;";
            $statement = "select DPTO, count(DPTO) as counter from empresa_directorio group by DPTO;";
            $pdo = new PDO($dsn, $user, $pass, $opt);
            $stmt = $pdo->prepare($statement);
            echo 'Connected to database';
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_OBJ);
            print_r($results);

            foreach ($results as $resultObj) {
                echo '<br />'. $resultObj->RAZON . ' - ' . $resultObj->ID_REG. '';
            }


//            echo "<br />Total SRL -> " . $result['count(*)'];
//
//
//            echo "<br />Total Emails -> " . $result['count(*)'];
        } catch(PDOException $e) {
            echo $e->getMessage();
        }

//        ob_start();
//
//        $content = ob_get_contents();
//        file_put_contents($cronFile, $content);
//        ob_end_flush();
//
        exit();

    }

}