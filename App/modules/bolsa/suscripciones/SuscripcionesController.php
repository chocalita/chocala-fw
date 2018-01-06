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
        $data = Req::all();
        $data['Ip'] = $_SERVER['REMOTE_ADDR'];
        $results = $this->empresaSuscritaService->insertAndNotify($data);
        $this->set('empresaSuscriptora', $results['object']);
        $this->set('success', $results['success']);
        $this->set('errors', $results['errors']);
        $this->set('email', $results['email']);
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