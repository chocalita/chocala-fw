<?php
/**
 * Description of ModuleController
 *
 * @author ypra
 */
class ModuleController extends AdminWebController
{

    /**
     * @var ModuleService
     * @service ModuleService
     */
    protected $moduleService;

    public function index()
    {
        $this->redirectTo(['action'=>'dataList']);
    }

    public function dataList()
    {
        $filters = Req::all();
        $filters['_page'] = $filters['_page']?: 1;
        //$filters['_max'] = $filters['_max']?: 10;  //comment for all results
        $modulePager = $this->moduleService->dataList($filters);
        $this->set('modulePager', $modulePager);
    }

    public function show()
    {
        $module = $this->objectIfExist();
        $this->set('module', $module);
        $this->set('uris', $module->uris());
    }

    public function create()
    {
        $module = new SysModule();
        $this->set('module', $module);
        $this->view->changeLayout('ajax');
    }

    public function save()
    {
        if(PageControl::canCreate()){
            $results = $this->moduleService->insertOrUpdate(Req::all());
            $this->set('module', $results['object']);
            $this->set('success', $results['success']);
            $this->set('errors', $results['errors']);
        }
        $this->renderAsJSON();
    }

    public function edit()
    {
        if(PageControl::canUpdate()){
            $module = $this->objectIfExist();
            $this->set('module', $module);
        }
        $this->view->changeLayout('ajax');
    }

    public function update()
    {
        if(PageControl::canUpdate()){
            $module = $this->objectIfExist();
            $results = $this->moduleService->insertOrUpdate(Req::all(), $module);
            $this->set('module', $results['object']);
            $this->set('success', $results['success']);
            $this->set('errors', $results['errors']);
        }
        $this->renderAsJSON();
    }

    public function objectIfExist()
    {
        try {
            return $this->moduleService->findPk($this->id);
        } catch (ChocalaException $che) {
            HttpManager::responseAs404();
        }
    }

}