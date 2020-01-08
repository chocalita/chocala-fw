<?php

/**
 * @author ypra
 * @date 20/5/2018
 * @time 17:14
 */
class AvisosController extends EmpresaAdminController
{

    /**
     * @var AvisoService Injected service
     * @service customers.aviso.AvisoService
     */
    protected $avisoService;

    /**
     * @var AreaService Injected service
     * @service parametros.area.AreaService
     */
    protected $areaService;

    /**
     * @var AreaReferenciaService Injected service
     * @service recursos.areaReferencia.AreaReferenciaService
     */
    protected $areaReferenciaService;

    /**
     * @var FormacionReferenciaService Injected service
     * @service recursos.formacionReferencia.FormacionReferenciaService
     */
    protected $formacionReferenciaService;

    public function index()
    {
        $this->redirectTo(['action' => 'avisosVigentes']);
    }

    public function avisosVigentes()
    {
        $filters = Req::all();
        $avisoPager = $this->avisoService->vigentesEmpresa($this->sessionEmpresaSuscrita, true, $filters);
        $this->set('avisoPager', $avisoPager);
    }

    public function show()
    {
        $aviso = $this->avisoEmpresa($this->id);
        $this->set('aviso', $aviso);
    }

    public function create()
    {
//        $aviso = new JobAviso();
        $areaReferenciaList = $this->areaReferenciaService->dataList();
        $formacionReferenciaList = $this->formacionReferenciaService->dataList(['activo' => true]);
//        print_r($this->sessionEmpresaSuscrita); exit();
        $this->set('empresaSuscrita', $this->sessionEmpresaSuscrita);
//        $this->set('aviso', $aviso);
        $this->set('fuentes', AppParam::param('JOB_FUENTES')->options());
        $this->set('localizaciones', AppParam::param('P_LOCALIZACIONES_AVISO')->options());
        $this->set('nivelesFormacion', JobAviso::$nivelesFormacion);
        $this->set('areaReferenciaList', $areaReferenciaList);
        $this->set('formacionReferenciaList', $formacionReferenciaList);
//        $this->view->changeLayout('ajax');
    }

    public function save()
    {
        //if(PageControl::canCreate()){
        $data = Req::all();
        $data['EmpresaSuscritaId'] = $this->sessionEmpresaSuscrita->getId();
        $data['FechaPublicacion'] = Req::_asDate('FechaPublicacion');
        $data['FechaVencimiento'] = Req::_asDate('FechaVencimiento');
        $data['AreasReferencia'] = [];
//        $data['AreasReferencia'] = Req::has('AreaReferencia') ?
//            implode(";", Req::_('AreaReferencia')) : '';
        $data['FormacionesReferencia'] = Req::has('FormacionReferencia') ?
            implode(";", Req::_('FormacionReferencia')) : '';
        if (isset($_FILES['picture'])) {
            $data['picture'] = $_FILES['picture'];
        }
        $results = $this->avisoService->insertOrUpdate($data);
        $this->set('aviso', $results['object']);
        $this->set('success', $results['success']);
        $this->set('errors', $results['errors']);
        // }
        $this->renderAsJSON();
    }

    public function edit()
    {
        $aviso = $this->avisoEmpresa($this->id);
        $this->checkUpdate($aviso);
        $areaList = $this->areaService->dataList();
        $areaReferenciaList = $this->areaReferenciaService->dataList();
        $formacionReferenciaList = $this->formacionReferenciaService->dataList(['activo' => true]);
        $this->set('aviso', $aviso);
        $this->set('fuentes', AppParam::param('JOB_FUENTES')->options());
        $this->set('localizaciones', AppParam::param('P_LOCALIZACIONES_AVISO')->options());
        $this->set('areaList', $areaList);
        $this->set('nivelesFormacion', JobAviso::$nivelesFormacion);
        $this->set('areaReferenciaList', $areaReferenciaList);
        $this->set('formacionReferenciaList', $formacionReferenciaList);
//        $this->view->changeLayout('ajax');
    }

    public function update()
    {
        if (PageControl::canUpdate()) {
            $aviso = $this->avisoEmpresa($this->id);
            $data = Req::all();
            $data['FechaPublicacion'] = Req::_asDate('FechaPublicacion');
            $data['FechaVencimiento'] = Req::_asDate('FechaVencimiento');
            $data['AreasReferencia'] = Req::has('AreaReferencia') ?
                implode(";", Req::_('AreaReferencia')) : '';
            $data['FormacionesReferencia'] = Req::has('FormacionReferencia') ?
                implode(";", Req::_('FormacionReferencia')) : '';
            if (isset($_FILES['picture'])) {
                $data['picture'] = $_FILES['picture'];
            }
            $results = $this->avisoService->insertOrUpdate($data, $aviso);
            $this->set('aviso', $results['object']);
            $this->set('success', $results['success']);
            $this->set('errors', $results['errors']);
        }
        $this->renderAsJSON();
    }

    public function avisoEmpresa($id)
    {
        $aviso = $this->avisoService->findPk($id);
        if ($aviso->getJobEmpresaSuscrita()->getId() != $this->sessionEmpresaSuscrita->getId()) {
            $this->redirectTo(['action' => 'index']);
        }
        return $aviso;
    }

    public function historialAvisos()
    {
        $filters = Req::all();
        $avisoPager = $this->avisoService->vigentesEmpresa($this->sessionEmpresaSuscrita, false, $filters);
        $this->set('avisoPager', $avisoPager);
    }

    public function empresa()
    {
        $usuariosEmpresaSuscrita = $this->sessionEmpresaSuscrita->getJobUserEmpresaSuscritas();
        $this->set("empresaSuscrita" , $this->sessionEmpresaSuscrita);
        $this->set("usuariosEmpresaSuscrita" , $usuariosEmpresaSuscrita);
    }

    public function perfil()
    {
        $this->set('user', $this->sessionUser);
        $this->set('person', $this->sessionUser->person());

        $usuariosEmpresaSuscrita = $this->sessionEmpresaSuscrita->getJobUserEmpresaSuscritas();
        $this->set("empresaSuscrita" , $this->sessionEmpresaSuscrita);
        $this->set("usuariosEmpresaSuscrita" , $usuariosEmpresaSuscrita);
//        $this->render("AQUI VA EL PERFIL DE USUARIO");
    }

    public function tutorial()
    {

    }

    public function alcance()
    {

    }

}