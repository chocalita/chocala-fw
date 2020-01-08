<?php
/**
 * Description of AreaController
 *
 * @author ypra
 */
class AreaController extends AdminWebController
{

    /**
     * @var AreaService Injected service
     * @service AreaService
     */
    protected $areaService;

    public function index()
    {
        $this->redirectTo(['action' => 'dataList']);
    }

    public function dataList()
    {
        $filters = Req::all();
        $filters['_page'] = $filters['_page']?: 1;
//        $filters['_max'] = $filters['_max']?: 20;  //comment for all results
        $areaPager = $this->areaService->dataList($filters);
        $this->set('areaPager', $areaPager);
    }

    public function show()
    {
        $area = $this->areaService->findPk($this->id);
        $this->set('area', $area);
    }

    public function create()
    {
        $area = new JobArea();
        $this->set('area', $area);
        $this->view->changeLayout('ajax');
    }

    public function save()
    {
        if(PageControl::canCreate()){
            $data = Req::all();
            $results = $this->areaService->insertOrUpdate($data);
            $this->set('area', $results['object']);
            $this->set('success', $results['success']);
            $this->set('errors', $results['errors']);
        }
        $this->renderAsJSON();
    }

    public function edit()
    {
        if(PageControl::canUpdate()){
            $area = $this->areaService->findPk($this->id);
            $this->set('area', $area);
        }
        $this->view->changeLayout('ajax');
    }

    public function update()
    {
        if(PageControl::canUpdate()){
            $area = $this->areaService->findPk($this->id);
            $results = $this->areaService->insertOrUpdate(Req::all(), $area);
            $this->set('area', $results['object']);
            $this->set('success', $results['success']);
            $this->set('errors', $results['errors']);
        }
        $this->renderAsJSON();
    }

    public function delete()
    {
        if(PageControl::canDelete()){
            $area = $this->areaService->findPk($this->id);
            $this->areaService->delete($area);
        }
        $this->redirectTo(['action'=>'dataList']);
    }

}