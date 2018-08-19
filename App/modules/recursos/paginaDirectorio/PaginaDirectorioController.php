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
        $limit = $this->id ?: 1000;
        $empresaDirectorios = JobEmpresaDirectorioQuery::create()
            ->filterByInfo("", Criteria::NOT_EQUAL)
            ->filterByTps(null)
            ->limit($limit)
            ->orderById(Criteria::DESC)
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
            $ed->setMatricula($jd['matricula']?: $ed->getMatricula());
            $ed->setRazon($jd['razon']?: $ed->getRazon());
            $ed->setTps($jd['tps']);
            $ed->setDpto($jd['dpto']);
            $ed->setMunicipio($jd['Municipio']);
            $ed->setDireccion($jd['Direccion']);
            $ed->setFono($jd['fono']);
            $ed->setFono2($jd['fono2']);
            $ed->setFechaMatricula($jd['fec_mat']);
            $ed->setFechaRenovacion($jd['fec_ren']);
            $ed->setUltRenov($jd['ult_renov']);
            $ed->setEstMat($jd['est_mat']);
            $ed->setCierre($jd['cierre']);
            $ed->setIdClase($jd['id_clase']);
            $ed->setNumId($jd['num_id']);
            $ed->setNombre($jd['nombre']);
            $ed->setCtrAct($jd['ctr_act']);
            $ed->setIdReg($jd['id_reg']);
            $ed->setVisible($jd['visible']);
            $ed->setFax($jd['fax']);
            $ed->setMail($jd['mail']);
            $ed->setActividad($jd['actividad']);
            $ed->setLicencia($jd['licencia']);
            $ed->setContacto($jd['contacto']);
            $ed->setIdMatricula($jd['id_matricula']?: $ed->getIdMatricula());
            $ed->setSeccion($jd['SECCION']?: $ed->getSeccion());
            $ed->setDivision($jd['DIVISION']);
            $ed->setClase($jd['CLASE']);
            $ed->setDes1($jd['DES1']);
            $ed->setDes2($jd['DES2']);
            $ed->setGrupo($jd['GRUPO']);
            $ed->setDes3($jd['DES3']);
            $ed->setDes4($jd['DES4']);
            $ed->save($con);
            if ($nInfo % 500 == 0) {
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

}