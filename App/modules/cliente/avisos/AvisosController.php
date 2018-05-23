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

    public function _init()
    {
        parent::_init();
    }

    public function index()
    {
        $this->redirectTo(['action' => 'avisosVigentes']);
    }

    public function avisosVigentes()
    {
        $empresaSuscrita = JobEmpresaSuscritaQuery::createValids()->findPk(1);
        $filters = Req::all();
        $avisoPager = $this->avisoService->vigentesEmpresa($empresaSuscrita, new DateTime(), $filters);
        $this->set('avisoPager', $avisoPager);
    }

}