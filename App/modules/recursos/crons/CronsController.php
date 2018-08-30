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
        $fileDir = APP_DIR.DIRECTORY_SEPARATOR.'mytest.txt';
        echo $fileDir;
        file_put_contents($fileDir, "Este es el test " . date("H:i:s"));


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
        ];

        try {
            $pdo = new PDO($dsn, $user, $pass, $opt);
            $stmt = $pdo->prepare("select count(*) from empresa_directorio where TPS like 'SOCIEDAD DE %'");
            echo 'Connected to database';
            $stmt->execute();
            $result = $stmt->fetch();
            echo "<br />Total SRL -> " . $result['count(*)'];

            $stmt = $pdo->prepare("select count(*) from empresa_directorio where TPS like 'SOCIEDAD DE %'");
            $stmt->execute();
            $result = $stmt->fetch();

            echo "<br />Total Emails -> " . $result['count(*)'];
            print_r($result);
        } catch(PDOException $e) {
            echo $e->getMessage();
        }


        $this->render("SUCCESS!");
    }

}