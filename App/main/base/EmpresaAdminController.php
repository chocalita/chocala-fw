<?php

/**
 * Description of AdminWebController
 *
 * @author ypra
 */
abstract class EmpresaAdminController extends AdminWebController
{

    /**
     * @var JobEmpresaSuscrita
     */
    protected $sessionEmpresaSuscrita = null;

    public function _init()
    {
        parent::_init();
        $this->view->changeLayout('suscripciones');
        $query = JobUserEmpresaSuscritaQuery::create()->filterBySysUser($this->sessionUser);
        $empresaSuscritaCount = $query->count();
        if ($empresaSuscritaCount == 1) {
            $userEmpresaSuscrita = $query->findOne();
            $this->sessionEmpresaSuscrita = $userEmpresaSuscrita->getJobEmpresaSuscrita();
        }
        if ($this->sessionEmpresaSuscrita == null) {
            // TODO: redirecto to security controls
            echo "NO SE ENCONTRO EMPRESA DE USUARIO";
            exit();
        }
    }

}