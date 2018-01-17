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
        if (is_object($empresaSuscrita)) {
            if ($empresaSuscrita->getStatus() == JobEmpresaSuscrita::STATUS_INITIAL) {
                $esEmpresaFormal = $empresaSuscrita->getSysEntityType()->getGroupCode() == SysEntityType::GROUP_FORMAL_COMPANY;
                $tipoSuscripcion = $esEmpresaFormal ? 'Empresa' : 'Negocio';
                $locaciones = SysLocationQuery::create()->filterByType("DEPARTAMENT")->find();

                $this->set('empresaSuscrita', $empresaSuscrita);
                $this->set('tipoSuscripcion', $tipoSuscripcion);
                $this->set('esEmpresaFormal', $esEmpresaFormal);
                $this->set('locaciones', $locaciones);
            } else {

                $this->redirectTo(URI::toModule() . 'trabajo/empresa');
            }
        } else {
            $this->redirectTo(URI::toModule() . 'trabajo/empresa');
        }
    }

    public function step1()
    {
        $results = ['success' => false, 'errors' => []];
        $empresaSuscrita = $this->empresaSuscritaService->findByHashCode(Req::_('hc'));
        if (is_object($empresaSuscrita) && $empresaSuscrita->getStatus() == JobEmpresaSuscrita::STATUS_INITIAL) {
            $data = Req::all();
            $data['Status'] = JobEmpresaSuscrita::STATUS_CONFIRMED;
            $empresaSuscrita->fromArray($data);
            $results['success'] = $empresaSuscrita->validate();
            $results['errors'] = $empresaSuscrita->getErrorsMap();
            if ($results['success']) {
                Session::set('empresaSuscrita', $empresaSuscrita);
            }
        }
        $this->set('success', $results['success']);
        $this->set('errors', $results['errors']);
        $this->renderAsJSON();
        return $results;
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
        $this->set('dirFichero', IMG_WEB . 'imgEntidad/' . $nombreFichero);
        $this->view->changeLayout('ajax');
        $this->renderAsJSON();
    }

} 