<?php
/**
 * Description of SuscripcionesController
 *
 * @author ypra
 * Date: 05/01/2018
 * Time: 06:59 PM
 */
class SuscripcionesController extends AdminWebController
{

    /**
     * @var EmpresaSuscritaService Injected service
     * @service customers.empresaSuscrita.EmpresaSuscritaService
     */
    protected $empresaSuscritaService;

    /**
     * @var EntityTypeService Injected service
     * @service customers.entityType.EntityTypeService
     */
    protected $entityTypeService;

    /**
     * @var LocationService Injected service
     * @service system.location.LocationService
     */
    protected $locationService;

    public function index()
    {
        $this->redirectTo(['action' => 'dataList']);
    }

    public function empresa()
    {
        $this->view->changeLayout('public');

        $empresaSuscrita = JobEmpresaSuscritaQuery::create()->findOneById(1);
        $esEmpresaFormal = $empresaSuscrita->getSysEntityType()->getGroupCode()==SysEntityType::GROUP_FORMAL_COMPANY;

        $locaciones = SysLocationQuery::create()->filterByType("DEPARTAMENT")->find();

        $this->set('empresaSuscrita', $empresaSuscrita);
        $this->set('esEmpresaFormal', $esEmpresaFormal);
        $this->set('locaciones', $locaciones);
    }

    public function aMethod()
    {
    }


    public function objectIfExist()
    {
        try {
            return $this->empresaSuscritaService->findPk($this->id);
        } catch (ChocalaException $che) {
            HttpManager::responseAs404();
        }
    }

    public function loadArchivoImg()
    {
        $hoy = date('Y-m-d');
        $nombreDirectorio = "";
        $nombreFichero = "";
        if (is_uploaded_file($_FILES['archivoImg']['tmp_name'])) {
            $nombreDirectorio = PUBLIC_DIR . 'images/imgEntidad/';

            $idUnico = ID_ENTITY;
            $nombreFichero = $nombreFichero . $idUnico . ".jpg";
            move_uploaded_file($_FILES['archivoImg']['tmp_name'],
                $nombreDirectorio . $nombreFichero);
        }
        $this->set('dirFichero', IMG_WEB.'imgEntidad/'.$nombreFichero);
        $this->view->changeLayout('ajax');
        $this->renderAsJSON();
    }

} 