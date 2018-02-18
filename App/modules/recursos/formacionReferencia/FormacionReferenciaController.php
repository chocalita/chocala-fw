<?php
Chocala::import("Model.utils.EmailSender");
Chocala::import("Modules.system.email.EmailService");

/**
 * Description of FormacionReferenciaController
 *
 * @author ypra
 */
class FormacionReferenciaController extends AdminWebController
{

    /**
     * @var FormacionReferenciaService Injected service
     * @service FormacionReferenciaService
     */
    protected $formacionReferenciaService;

    /**
     * @var AreaReferenciaService Injected service
     * @service recursos.areaReferencia.AreaReferenciaService
     */
    protected $areaReferenciaService;

    public function index()
    {
        $this->redirectTo(['action' => 'dataList']);
    }

    public function dataList()
    {
        $filters = Req::all();
        $filters['_page'] = $filters['_page'] ?: 1;
//        $filters['_max'] = $filters['_max']?: 20;  //comment for all results
        $formacionesPager = $this->formacionReferenciaService->dataList($filters);
        $this->set('formacionesPager', $formacionesPager);
    }

    public function show()
    {
        $area = $this->objectIfExist();
        $this->set('area', $area);
    }

    public function create()
    {
        $areaReferenciaList = $this->areaReferenciaService->dataList();
        $formacionReferenciaList = $this->formacionReferenciaService->dataList();
        $this->set('areaReferenciaList', $areaReferenciaList);
        $this->set('formacionReferenciaList', $formacionReferenciaList);
    }

    public function save()
    {
        if (PageControl::canCreate()) {
            $data = Req::all();
            $data['AreasReferencia'] = Req::has('AreaReferencia') ?
                implode(";", Req::_('AreaReferencia')) : '';
            $data['FormacionesReferencia'] = Req::has('FormacionReferencia') ?
                implode(";", Req::_('FormacionReferencia')) : '';
            $results = $this->formacionReferenciaService->insertOrUpdate($data);
            $this->set('formacionReferencia', $results['object']);
            $this->set('success', $results['success']);
            $this->set('errors', $results['errors']);
        }
        $this->renderAsJSON();
    }

    public function edit()
    {
        if (PageControl::canUpdate()) {
            $formacionReferencia = $this->objectIfExist();
            $areaReferenciaList = $this->areaReferenciaService->dataList();
            $formacionReferenciaList = $this->formacionReferenciaService->dataList();
            $this->set('formacionTmp', $formacionReferencia);
            $this->set('areaReferenciaList', $areaReferenciaList);
            $this->set('formacionReferenciaList', $formacionReferenciaList);
        }
    }

    public function update()
    {
        if (PageControl::canUpdate()) {
            $formacionTmp = $this->objectIfExist();
            $data['AreasReferencia'] = Req::has('AreaReferencia') ?
                implode(";", Req::_('AreaReferencia')) : '';
            $data['FormacionesReferencia'] = Req::has('FormacionReferencia') ?
                implode(";", Req::_('FormacionReferencia')) : '';
            $results = $this->formacionReferenciaService->insertOrUpdate($data, $formacionTmp);
            $this->set('formacionReferencia', $results['object']);
            $this->set('success', $results['success']);
            $this->set('errors', $results['errors']);
        }
        $this->renderAsJSON();
    }

    public function objectIfExist()
    {
        try {
            return $this->formacionReferenciaService->findPk($this->id);
        } catch (ChocalaException $che) {
            HttpManager::responseAs404();
        }
    }

    public function delete()
    {
        if (PageControl::canDelete()) {
            $area = $this->objectIfExist();
            $this->areaService->delete($area);
        }
        $this->redirectTo(['action' => 'dataList']);
    }

}