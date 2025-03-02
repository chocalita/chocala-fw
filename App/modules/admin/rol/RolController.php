<?php
/**
 * Description of ModulesController
 *
 * @author ypra
 */
class RolController extends AdminWebController
{

    /**
     * @var RolService
     * @service RolService
     */
    protected $rolService;

    public function index()
    {
        $this->redirectTo(['action'=>'dataList']);
    }

    public function dataList()
    {
        $filters = Req::all();
        $filters['_page'] = $filters['_page']?: 1;
        $filters['_max'] = $filters['_max']?: 10;
        $rolPager = $this->rolService->dataList($filters);
        //Session::set('rolesList', $rols);
        //$rols * Session::_('rolesList');
        //Session::has('rolesList');
        //Session::delete('rolesList');
        $this->set('rolPager', $rolPager);
    }

    public function create()
    {
        $rol = new SysRol();
        $this->set('rol', $rol);
        $this->view->changeLayout('ajax');
    }

    public function save()
    {
        if(PageControl::canCreate()){
            $results = $this->rolService->insertOrUpdate(Req::all());
            $this->set('rol', $results['object']);
            $this->set('success', $results['success']);
            $this->set('errors', $results['errors']);
            $this->renderAsJSON();
        }
    }

    public function edit()
    {
        if(PageControl::canUpdate()){
            $rol = $this->rolService->findPk($this->id);
            $this->set('rol', $rol);
        }
        $this->view->changeLayout('ajax');
    }

    public function update()
    {
        if(PageControl::canUpdate()){
            $rol = $this->rolService->findPk($this->id);
            $results = $this->rolService->insertOrUpdate(Req::all(), $rol);
            $this->set('rol', $results['object']);
            $this->set('success', $results['success']);
            $this->set('errors', $results['errors']);
        }
        $this->renderAsJSON();
    }

    public function delete()
    {
        $rol = $this->rolService->findPk($this->id);
        if(PageControl::canDelete()){
            $rol->delete();
        }
        $this->redirectTo(['action' => 'index']);
    }

}