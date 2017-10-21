<?php

/**
 * Description of IndexController
 *
 * @author ypra
 */
class IndexController extends PublicWebController
{

    /**
     * @var AvisoService
     * @service customers.aviso.AvisoService
     */
    protected $avisoService;

    public function index()
    {
        $this->set('message', 'This page is running successfully!');
        $avisosVigentes = $this->avisoService->listVigencia(true);
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
        $this->set('avisosOdd', $avisosOdd);
        $this->set('avisosEven', $avisosEven);
    }

    public function test()
    {
    }

    public function oportunidad()
    {
        $aviso = $this->avisoIfExist();
        $this->set('aviso', $aviso);
        Cookie::set("advertising", "no");
        $this->view->changeLayout('ajax');
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