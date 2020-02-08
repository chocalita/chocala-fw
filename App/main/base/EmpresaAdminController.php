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
        $queryUserEmpresaSuscrita = JobUserEmpresaSuscritaQuery::create()->filterBySysUser($this->sessionUser);
        $empresaSuscritaCount = $queryUserEmpresaSuscrita->count();
        if ($empresaSuscritaCount == 1) {
            $userEmpresaSuscrita = $queryUserEmpresaSuscrita->findOne();
            $this->sessionEmpresaSuscrita = $userEmpresaSuscrita->getJobEmpresaSuscrita();
        } else {
            echo "EMPRESAS ENCONTRADAS PARA EL USUARIO -> " . $empresaSuscritaCount;
            exit();
        }
        if ($this->sessionEmpresaSuscrita == null) {
            // TODO: redirecto to security controls
            echo "NO SE ENCONTRO EMPRESA DE USUARIO";
            exit();
        }
    }

    public function checkUpdate(JobAviso $object)
    {
        if(!PageControl::canUpdate() || !$this->isTenantOwner($object)){
            throw new ForbiddenException("Forbidden Exception");
        }
    }

    public function isTenantOwner(JobAviso $object)
    {
        return is_object($this->sessionEmpresaSuscrita) && is_object($object) &&
            $this->sessionEmpresaSuscrita->getId() == $object->getEmpresaSuscritaId();
    }

}