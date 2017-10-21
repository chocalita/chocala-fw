<?php
/**
 * Description of ModulesController
 *
 * @author ypra
 */
class UriController extends AdminWebController
{

    /**
     * @var UriService
     * @service UriService
     */
    protected $uriService;

    /**
     * @var ModuleService
     * @service admin.module.ModuleService
     */
    protected $moduleService;

    /**
     * @var RolService
     * @service admin.rol.RolService
     */
    protected $rolService;

    public function index()
    {
        $this->redirectTo(['controller' => 'module']);
    }

    public function module()
    {
        $module = $this->moduleService->findPk($this->id);
        $uris = $module->uris();
        $this->set('module', $module);
        $this->set('uris', $uris);
    }

    public function create()
    {
        $uri = new SysUri();
        $module = $this->moduleService->findPk($this->id);
        $this->set('uri', $uri);
        $this->set('module', $module);
        $this->view->changeLayout('ajax');
    }

    public function save()
    {
        if(PageControl::canCreate()){
            $results = $this->uriService->insertOrUpdate(Req::all());
            $this->set('uri', $results['object']);
            $this->set('success', $results['success']);
            $this->set('errors', $results['errors']);
            $this->renderAsJSON();
        }
    }

    public function edit()
    {
        if(PageControl::canUpdate()){
            $uri = $this->objectIfExist();
            $this->set('uri', $uri);
            $this->set('modules', $this->moduleService->dataList());
            $this->set('module', $uri->getSysModule());
        }
        $this->view->changeLayout('ajax');
    }

    public function update()
    {
        if(PageControl::canCreate()){
            $uri = $this->objectIfExist();
            $results = $this->uriService->insertOrUpdate(Req::all(), $uri);
            $this->set('uri', $results['object']);
            $this->set('success', $results['success']);
            $this->set('errors', $results['errors']);
            $this->renderAsJSON();
        }
    }

    public function toDelete()
    {
        $uri = SysUriQuery::create()->findPk($this->id);
        $this->set('uri', $uri);
    }

    public function objectIfExist()
    {
        try {
            return $this->uriService->findPk($this->id);
        } catch (ChocalaException $che) {
            HttpManager::responseAs404();
        }
    }

    public function rolesAccess()
    {
        $uri = $this->uriService->findPk($this->id);
        $this->set('uri', $uri);
        $this->set('roles', $this->rolService->dataList());
        $this->set('rolesUri', $uri->rolUris());
        $this->view->changeLayout('ajax');
    }

    public function changeMainPermission()
    {
        $this->set('permission', $this->uriService->changeMainPermission(
            Req::_('rolId'), Req::_('uriId')));
        $this->renderAsJSON();
    }

    public function changePermissionType()
    {
        $this->set('permission', $this->uriService->changePermissionType(
            Req::_('type'), Req::_('rolId'), Req::_('uriId')));
        $this->renderAsJSON();
    }

}