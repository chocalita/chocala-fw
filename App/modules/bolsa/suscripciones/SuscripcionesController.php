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

    /**
     * @var FormacionReferenciaService Injected service
     * @service recursos.formacionReferencia.FormacionReferenciaService
     */
    protected $formacionReferenciaService;

    public function index()
    {
        $this->redirectTo(['action' => 'dataList']);
    }

    public function empresa()
    {
        $this->view->changeLayout('public');
        $empresaSuscrita = JobEmpresaSuscritaQuery::create()->findOneByHashCode($this->id);
        if (is_object($empresaSuscrita)) {
            if ($empresaSuscrita->getStatus() == JobEmpresaSuscrita::STATUS_INITIAL) {
                $esEmpresaFormal = $empresaSuscrita->getSysEntityType()->getGroupCode() == SysEntityType::GROUP_FORMAL_COMPANY;
                $tipoSuscripcion = $esEmpresaFormal ? 'Empresa' : 'Negocio';
                $locaciones = SysLocationQuery::create()->filterByType("DEPARTMENT")->find();
                $formacionReferenciaList = $this->formacionReferenciaService->dataList(['activo' => true]);
                $this->set('localizaciones', AppParam::param('P_LOCALIZACIONES_AVISO')->options());
                $this->set('empresaSuscrita', $empresaSuscrita);
                $this->set('tipoSuscripcion', $tipoSuscripcion);
                $this->set('esEmpresaFormal', $esEmpresaFormal);
                $this->set('locaciones', $locaciones);
                $this->set('nivelesFormacion', JobAviso::$nivelesFormacion);
                $this->set('formacionReferenciaList', $formacionReferenciaList);
            } else {
                $this->redirectTo(WEB_ROOT);
            }
        } else {
            $this->redirectTo(['url' => URI::toModule() . 'trabajo/empresa']);
        }
    }

    public function step1()
    {
        $results = ['success' => false, 'errors' => []];
        $empresaSuscrita = $this->empresaSuscritaService->findByHashCode(Req::_('hc'));
        if (is_object($empresaSuscrita) && $empresaSuscrita->getStatus() == JobEmpresaSuscrita::STATUS_INITIAL) {
            $data = Req::all();
            if (isset($_FILES['logo'])) {
                $data['logo'] = $_FILES['logo'];
            }
            $results = $this->empresaSuscritaService->verifyEmpresaSuscrita($empresaSuscrita, $data);
        }
        $this->set('success', $results['success']);
//        $this->set('success', true);
        $this->set('errors', $results['errors']);
        $this->renderAsJSON();
    }

    public function step2()
    {
        $results = ['success' => false, 'errors' => []];
        $empresaSuscrita = $this->empresaSuscritaService->findByHashCode(Req::_('hc'));
        if (is_object($empresaSuscrita) && $empresaSuscrita->getStatus() == JobEmpresaSuscrita::STATUS_INITIAL) {
            $data = Req::all();
            $results = $this->empresaSuscritaService->verifyUserAccount($data);
        }
        $this->set('success', $results['success']);
//        $this->set('success', true);
        $this->set('errors', $results['errors']);
        $this->renderAsJSON();
    }

    public function step3()
    {
        $results = ['success' => false, 'errors' => []];
        $empresaSuscrita = $this->empresaSuscritaService->findByHashCode(Req::_('hc'));
        if (is_object($empresaSuscrita) && $empresaSuscrita->getStatus() == JobEmpresaSuscrita::STATUS_INITIAL) {
            $data = Req::all();
            $data['NombreEmpresa'] = $empresaSuscrita->getNombre();
            $data['FechaVencimiento'] = Req::_asDate('FechaVencimiento');
//        $data['AreasReferencia'] = Req::has('AreaReferencia') ?
//            implode(";", Req::_('AreaReferencia')) : '';
            $data['FormacionesReferencia'] = Req::has('FormacionReferencia') ?
                implode(";", array_unique(Req::_('FormacionReferencia'))) : '';
            $results = $this->empresaSuscritaService->verifyAviso($data);
        }
        $this->set('success', $results['success']);
//        $this->set('success', true);
        $this->set('errors', $results['errors']);
        $this->renderAsJSON();
    }

    public function finish($data)
    {
        $results = ['success' => false, 'errors' => []];
        $empresaSuscrita = $this->empresaSuscritaService->findByHashCode(Req::_('hc'));
        if (is_object($empresaSuscrita) && $empresaSuscrita->getStatus() == JobEmpresaSuscrita::STATUS_INITIAL) {
            $data = Req::all();
            $results = $this->empresaSuscritaService->finalizarSuscripcion($data);
        }

        $this->set('success', $results['success']);
        $this->set('errors', $results['errors']);
        if ($results['success']) {
            $this->set('nombreSuscriptor', $results['nombreSuscriptor']);
            $this->set('empresaSuscrita', $results['empresaSuscrita']);
            $this->set('requerimientoPublicado', $results['requerimientoPublicado']);
            $this->set('idAviso', $results['idAviso']);
        }
        $this->renderAsJSON();
    }

    public function publicada()
    {
        print_r(Session::_(EmpresaSuscritaService::SESSION_VAR));
        $this->render("Se completo el registro");
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