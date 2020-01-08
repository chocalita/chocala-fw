<?php
/**
 * Description of AreaTecnicaController
 *
 * @author ypra
 */
class AreaTecnicaController extends AdminWebController
{
    /**
     * @var AreaTecnicaService Injected service
     * @service AreaTecnicaService
     */
    protected $areaTecnicaService;

    public function index()
    {
        $this->redirectTo(['action' => 'dataList']);
    }

    public function dataList()
    {
        $filters = Req::all();
        $filters['_page'] = $filters['_page']?: 1;
//        $filters['_max'] = $filters['_max']?: 20;  //comment for all results
        $areaTecnicaPager = $this->areaTecnicaService->dataList($filters);
        $this->set('areaTecnicaPager', $areaTecnicaPager);
    }

    public function show()
    {
        $areaTecnica = $this->areaTecnicaService->findPk($this->id);
        $this->set('areaTecnica', $areaTecnica);
    }

    public function create()
    {
        $areaTecnica = new JobAreaTecnica();
        $this->set('areaTecnica', $areaTecnica);
        $this->view->changeLayout('ajax');
    }

    public function save()
    {
        if(PageControl::canCreate()){
            $data = Req::all();
 //           $data['Status'] =  Req::has('estadoInactivo') ? SoftDelete::ACTIVE:SoftDelete::INACTIVE;
            $results = $this->areaTecnicaService->insertOrUpdate($data);
            $this->set('areaTecnica', $results['object']);
            $this->set('success', $results['success']);
            $this->set('errors', $results['errors']);
        }
        $this->renderAsJSON();
    }

    public function edit()
    {
        if(PageControl::canUpdate()){
            $areaTecnica = $this->areaTecnicaService->findPk($this->id);
            $this->set('areaTecnica', $areaTecnica);
        }
        $this->view->changeLayout('ajax');
    }

    public function update()
    {
        if(PageControl::canUpdate()){
            $areaTecnica = $this->areaTecnicaService->findPk($this->id);
            $results = $this->areaTecnicaService->insertOrUpdate(Req::all(), $areaTecnica);
            $this->set('areaTecnica', $results['object']);
            $this->set('success', $results['success']);
            $this->set('errors', $results['errors']);
        }
        $this->renderAsJSON();
    }

    public function delete()
    {
        if(PageControl::canDelete()){
            $areaTecnica = $this->areaTecnicaService->findPk($this->id);
            $this->areaTecnicaService->delete($areaTecnica);
        }
        $this->redirectTo(['action'=>'dataList']);
    }
}