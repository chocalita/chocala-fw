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
    }

    public function test()
    {
    }

    public function oportunidad()
    {
        $aviso = $this->avisoIfExist();
        $this->set('aviso', $aviso);
        Cookie::set("advertising", "no");
        if (HttpManager::isAJAXRequest()) {
            $this->view->changeLayout('ajax');
        } else {
            $this->view->renderView('index.oportunidadSEO', "main");
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

}