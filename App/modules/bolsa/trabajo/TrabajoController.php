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

    const SUSCRIPCION_MSG_COOKIE = "SUSCRIPCION_MSG";

    public function index()
    {
        $this->set('message', 'This page is running successfully!');
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
//        if(!Cookie::has(self::SUSCRIPCION_MSG_COOKIE)){
//        print_r($_COOKIE); exit();
//        unset($_COOKIE[self::SUSCRIPCION_MSG_COOKIE]);
        if(!$_COOKIE[self::SUSCRIPCION_MSG_COOKIE]){
            $this->set('SUSCRIPCION_MSG_COOKIE', self::SUSCRIPCION_MSG_COOKIE);
        }
//        echo Cookie::_("advertising"); exit();
//        setcookie("advertising", "no");
    }

    public function empleo()
    {
        $aviso = $this->avisoIfExist();
        $this->set('aviso', $aviso);
        Cookie::set("advertising", "no");
        if (HttpManager::isAJAXRequest()) {
            $this->view->changeLayout('ajax');
        } else {
            $this->view->renderView('trabajo.empleoSEO', "bolsa");
//            $this->renderView('oportunidadSEO', "index");
        }
    }


    public function test()
    {
    }


    public function avisoIfExist()
    {
        try {
            return $this->avisoService->findPk($this->id);
        } catch (ChocalaException $che) {
            HttpManager::responseAs404();
        }
    }

}