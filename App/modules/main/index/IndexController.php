<?php

/**
 * Description of IndexController
 *
 * @author ypra
 */
class IndexController extends PublicWebController
{

    public function index()
    {
        $this->set('message', 'This page is running successfully!');
    }

    public function test()
    {
    }

    public function oportunidad()
    {
        Cookie::set("advertising", "no");
        if (HttpManager::isAJAXRequest()) {
            $this->view->changeLayout('ajax');
        } else {
            $this->view->renderView('index.oportunidadSEO', "main");
//            $this->renderView('oportunidadSEO', "index");
        }
    }

}