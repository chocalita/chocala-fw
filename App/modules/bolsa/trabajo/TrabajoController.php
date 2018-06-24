<?php

/**
 * Description of TrabajoController
 *
 * @author ypra
 */
class TrabajoController extends PublicWebController
{

    /**
     * @var AvisoService
     * @service customers.aviso.AvisoService
     */
    protected $avisoService;

    /**
     * @var EntityTypeService Injected service
     * @service customers.entityType.EntityTypeService
     */
    protected $entityTypeService;

    /**
     * @var EmpresaSuscritaService
     * @service customers.empresaSuscrita.EmpresaSuscritaService
     */
    protected $empresaSuscritaService;

    /**
     * @var SuscriptorService
     * @service customers.suscriptor.SuscriptorService
     */
    protected $suscriptorService;

    /**
     * @var FormacionReferenciaService Injected service
     * @service recursos.formacionReferencia.FormacionReferenciaService
     */
    protected $formacionReferenciaService;

    const SUSCRIPCION_MSG_COOKIE = "SUSCRIPCION_MSG_TMP2";

    public function index()
    {
        $avisosVigentes = $this->avisoService->listVigencia(true);
        $totalMes = $this->avisoService->countVigentesMes();
        $totalMesPasado = $this->avisoService->countVigentesMesPasado();
        $avisosOdd = [];
        $avisosEven = [];
        $i = 0;
        foreach ($avisosVigentes as $aviso) {
            if ($i++ % 2) {
                array_push($avisosEven, $aviso);
            } else {
                array_push($avisosOdd, $aviso);
            }
        }
        $this->set('avisosVigentes', $avisosVigentes);
        $this->set('totalMes', $totalMes);
        $this->set('totalMesPasado', $totalMesPasado);
        $this->set('avisosOdd', $avisosOdd);
        $this->set('avisosEven', $avisosEven);
        // TODO: send an email on suscription
        if (!Cookie::has(self::SUSCRIPCION_MSG_COOKIE)) {
            $formacionReferenciaList = $this->formacionReferenciaService->dataList(['activo' => true]);
            $this->set('formacionReferenciaList', $formacionReferenciaList);
            $this->set('SUSCRIPCION_MSG_COOKIE', self::SUSCRIPCION_MSG_COOKIE);
        }
    }

    public function lista()
    {
        $avisosVigentes = $this->avisoService->listVigencia(true);
        $totalMes = $this->avisoService->countVigentesMes();
        $totalMesPasado = $this->avisoService->countVigentesMesPasado();
        $avisosOdd = [];
        $avisosEven = [];
        $i = 0;
        foreach ($avisosVigentes as $aviso) {
            if ($i++ % 2) {
                array_push($avisosEven, $aviso);
            } else {
                array_push($avisosOdd, $aviso);
            }
        }
        $this->set('avisosVigentes', $avisosVigentes);
        $this->set('totalMes', $totalMes);
        $this->set('totalMesPasado', $totalMesPasado);
        $this->set('avisosOdd', $avisosOdd);
        $this->set('avisosEven', $avisosEven);
    }

    public function empleo()
    {
        $aviso = $this->avisoIfExist();
        $this->set('aviso', $aviso);
        Cookie::set("advertising", "no");
        if (HttpManager::isAJAXRequest()) {
            $this->view->changeLayout('ajax');
        } else {
            Flash::set('page_title', 'Empleos.Click - Trabajos en Bolivia - ' . $aviso->getCargo());
            Flash::set('page_description', 'Trabajo para ' . $aviso->getCargo() . ' en ' .
                ($aviso->getLocalizacion() ?: $aviso->getNombreEmpresa()) .
                ". Requerimiento de Personal para " . ucwords(strtolower($aviso->getFormacionesReferencia())) .
                ". " . $aviso->getRequisito());
            $this->view->renderView('trabajo.empleoSEO', "bolsa");
//            $this->renderView('oportunidadSEO', "index");
        }
    }

    public function avisoIfExist()
    {
        try {
            return $this->avisoService->findPk($this->id);
        } catch (ChocalaException $che) {
            HttpManager::responseAs404();
        }
    }

    public function suscripcion()
    {
        $data = Req::all();
        $data['Ip'] = $_SERVER['REMOTE_ADDR'];
        $results = $this->suscriptorService->insertAndNotify($data);
        $this->set('suscriptor', $results['object']);
        $this->set('success', $results['success']);
        $this->set('errors', $results['errors']);
        $this->set('email', $results['email']);
        $this->renderAsJSON();
    }

    public function empresa()
    {
        $entityTypeList = $this->entityTypeService
            ->dataList(['groupCode' => [SysEntityType::GROUP_FORMAL_COMPANY, SysEntityType::GROUP_BUSINESS]]);
        $this->set('entityTypeList', $entityTypeList);
    }


    public function suscribirEmpresa()
    {
        $data = Req::all();
        $data['IpCreacion'] = $_SERVER['REMOTE_ADDR'];
        $results = $this->empresaSuscritaService->insertAndNotify($data);
        $this->set('empresaSuscriptora', $results['object']);
        $this->set('success', $results['success']);
        $this->set('errors', $results['errors']);
        $this->set('email', $results['email']);
        $this->renderAsJSON();
    }

}