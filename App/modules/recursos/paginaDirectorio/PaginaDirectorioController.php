<?php
Chocala::import('Model.utils.simple_html_dom');
/**
 * Description of PaginaDirectorioController
 *
 * @author ypra
 */
class PaginaDirectorioController extends AdminWebController
{

    /**
     * @var PaginaDirectorioService Injected service
     * @service PaginaDirectorioService
     */
    protected $paginaDirectorioService;

    public function index()
    {
        $departamentos = $this->paginaDirectorioService->departamentos();
        $resumenData = $this->paginaDirectorioService->resumen();
        $this->set('departamentos', $departamentos);
        $this->set('resumenData', $resumenData);
    }

    public function readPages()
    {
        $depto = Req::_('Departamento');
        $tiempo = Req::_('Tiempo');
        $departamentos = $this->paginaDirectorioService->departamentos();
        if(array_key_exists($depto, $departamentos)){
            $this->paginaDirectorioService->leerDepartamentoTimeout($depto, $tiempo);
        }
        $this->redirectTo(['action' => 'index', 'params' => ['Departamento' => $depto]]);
    }

    public function test()
    {
//        $this->paginaDirectorioService->leerDepartamentoTimeout('02', 20);
        $empresa = ScrapEmpresaQuery::createValids()->findOneByIdEmpresa('3cf74613018208cb3a762093812095ae');
        $this->paginaDirectorioService->scrapEmpresa($empresa);
        $this->render("FINALIZADO");
    }

    public function obtenerDirectorio()
    {
        $this->paginaDirectorioService->scraping();
        exit();
    }

    public function completarDirectorio()
    {
        $this->paginaDirectorioService->scraping2();
        exit();
    }


    public function procesarInfo()
    {
        $minId = 0;
        $limit = $this->id ?: 20000;
        $empresaDirectorios = JobEmpresaDirectorioQuery::create()
//            ->filterByInfo("[]", Criteria::NOT_EQUAL)
            ->filterByTps(null)
            ->filterById($minId, Criteria::GREATER_THAN)
            ->orderById(Criteria::DESC)
            ->limit($limit)
            ->find();
        $con = \Propel\Runtime\Propel::getConnection();
        $con->beginTransaction();
        $i = 0;
        $nInfo = 0;
        foreach ($empresaDirectorios as $ed) {
            $i++;
            $nInfo++;
            $jd = (array) json_decode($ed->getInfo(),true);
            $jd = $jd[0];
            $ed->setMatricula(trim($jd['matricula']) ?: $ed->getMatricula());
            $ed->setRazon(trim($jd['razon']) ?: $ed->getRazon());
            $ed->setTps(trim($jd['tps']) ?: null);
            $ed->setDpto(trim($jd['dpto']) ?: null);
            $ed->setMunicipio(trim($jd['Municipio']) ?: null);
            $ed->setDireccion(trim($jd['Direccion']) ?: null);
            $ed->setFono(trim($jd['fono']) ?: null);
            $ed->setFono2(trim($jd['fono2']) ?: null);
            $ed->setFechaMatricula(trim($jd['fec_mat']) ?: null);
            $ed->setFechaRenovacion(trim($jd['fec_ren']) ?: null);
            $ed->setUltRenov(trim($jd['ult_renov']) ?: null);
            $ed->setEstMat(trim($jd['est_mat']) ?: null);
            $ed->setCierre(trim($jd['cierre']) ?: null);
            $ed->setIdClase(trim($jd['id_clase']) ?: null);
            $ed->setNumId(trim($jd['num_id']) ?: null);
            $ed->setNombre(trim($jd['nombre']) ?: null);
            $ed->setCtrAct(trim($jd['ctr_act']) ?: null);
            $ed->setIdReg(trim($jd['id_reg']) ?: null);
            $ed->setVisible(trim($jd['visible']) ?: null);
            $ed->setFax(trim($jd['fax']) ?: null);
            $ed->setMail(trim($jd['mail']) ?: null);
            $ed->setActividad(trim($jd['actividad']) ?: null);
            $ed->setLicencia(trim($jd['licencia']) ?: null);
            $ed->setContacto(trim($jd['contacto']) ?: null);
            $ed->setIdMatricula(trim($jd['id_matricula'])?: $ed->getIdMatricula());
            $ed->setSeccion(trim($jd['SECCION'])?: $ed->getSeccion());
            $ed->setDivision(trim($jd['DIVISION']) ?: null);
            $ed->setClase(trim($jd['CLASE']) ?: null);
            $ed->setDes1(trim($jd['DES1']) ?: null);
            $ed->setDes2(trim($jd['DES2']) ?: null);
            $ed->setGrupo(trim($jd['GRUPO']) ?: null);
            $ed->setDes3(trim($jd['DES3']) ?: null);
            $ed->setDes4(trim($jd['DES4']) ?: null);
            $ed->save($con);
            if ($nInfo % 200 == 0) {
                $con->commit();
                $con->beginTransaction();
                $i = 0;
                echo "Procesados " . $nInfo . " - " . date("d/M/y h:i:s") . "<br />";
            }
//            echo $ed->getNombre() . "<br>";
        }
        $con->commit();
        echo "Total Procesados " . $nInfo . " - " . date("d/M/y h:i:s") . "<br />";
        exit();
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

    public function sanearDatos() {
        $objs = JobEmpresaDirectorioQuery::create()
            ->filterByActividad("% ", Criteria::LIKE)
            ->find();
        echo $objs->count();
        exit();
//        $objs = JobEmpresaDirectorioQuery::create()
//            ->orderById()
//            ->offset(135000)
//            ->limit(50000)
//            ->find();
        $con = \Propel\Runtime\Propel::getConnection();
        $con->beginTransaction();
        $nInfo = 0;
        foreach ($objs as $obj) {
            $obj->setRazon(trim($obj->getRazon())?: null);
            $obj->setTps(trim($obj->getTps())?: null);
            $obj->setDpto(trim($obj->getDpto())?: null);
            $obj->setMunicipio(trim($obj->getMunicipio())?: null);
            $obj->setDireccion(trim($obj->getDireccion())?: null);
            $obj->setFono(trim($obj->getFono())?: null);
            $obj->setFono2(trim($obj->getFono2())?: null);
            $obj->setEstMat(trim($obj->getEstMat())?: null);
            $obj->setIdClase(trim($obj->getIdClase())?: null);
            $obj->setNumId(trim($obj->getNumId())?: null);
            $obj->setNombre(trim($obj->getNombre())?: null);
            $obj->setCtrAct(trim($obj->getCtrAct())?: null);
            $obj->setIdReg(trim($obj->getIdReg())?: null);
            $obj->setFax(trim($obj->getFax())?: null);
            $obj->setMail(trim($obj->getMail())?: null);
            $obj->setActividad(trim($obj->getActividad())?: null);
            $obj->setLicencia(trim($obj->getLicencia())?: null);
            $obj->setContacto(trim($obj->getContacto())?: null);
            $obj->setSeccion(trim($obj->getSeccion())?: null);
            $obj->setDes1(trim($obj->getDes1())?: null);
            $obj->setDes2(trim($obj->getDes2())?: null);
            $obj->setDes3(trim($obj->getDes3())?: null);
            $obj->setDes4(trim($obj->getDes4())?: null);
            $obj->save();
//            $obj->save($con);
            $nInfo++;
            if ($nInfo % 500 == 0) {
//                $con->commit();
//                $con->beginTransaction();
//                $i = 0;
                echo "Procesados " . $nInfo . " - " . date("d/M/y h:i:s") . "<br />";
            }
        }
//        $con->commit();
        $this->render("HECHO TODO!");
    }

    public function testSicoes()
    {

        $target = "https://www.infosicoes.com/contratacion-de-un-1-consultor-a-por-producto-para-la-sustanciacion-y-seguimiento-de-procesos-en-el-marco-de-los-decretos-supremos-1302-y-1320-gestion-2019-en-los-departa-lct374388.html";
        $htmlPage = file_get_contents($target);
        print_r($htmlPage);
        $htmlDom = simple_html_dom::str_get_html($htmlPage);
        $nodesA = $htmlDom->find('td[class=FormularioEtiqueta]');
        $nodesB = $htmlDom->find('td[class=FormularioDato]');

        echo sizeof($nodesA);
        foreach ($nodesA as $node) {
            echo "<br >". $node->plaintext;
        }
        foreach ($nodesB as $node) {
            echo "<br >". $node->plaintext;
        }
//        print_r($nodesA);
//        print_r($nodesB);
        exit();



    }

}