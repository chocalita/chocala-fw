<?php

/**
 * Description of AvisoController
 *
 * @author ypra
 */
class AvisoController extends AdminWebController
{

    /**
     * @var AvisoService Injected service
     * @service customers.aviso.AvisoService
     */
    protected $avisoService;

    /**
     * @var AreaService Injected service
     * @service parametros.area.AreaService
     */
    protected $areaService;

    /**
     * @var AreaReferenciaService Injected service
     * @service recursos.areaReferencia.AreaReferenciaService
     */
    protected $areaReferenciaService;

    /**
     * @var FormacionReferenciaService Injected service
     * @service recursos.formacionReferencia.FormacionReferenciaService
     */
    protected $formacionReferenciaService;

    public function index()
    {
        $this->redirectTo(['action' => 'dataList']);
    }

    public function dataList()
    {
        $filters = Req::all();
        $filters['_page'] = $filters['_page'] ?: 1;
//        $filters['_max'] = $filters['_max']?: 20;  //comment for all results
        $listVigentes = $this->avisoService->listVigencia();
        $listNoVigentes = $this->avisoService->listVigencia(false);
        $avisoPager = $this->avisoService->dataList($filters);
        $this->set('avisoPager', $avisoPager);
        $this->set('listVigentes', $listVigentes);
        $this->set('listNoVigentes', $listNoVigentes);
    }

    public function show()
    {
        $aviso = $this->objectIfExist();
        $this->set('aviso', $aviso);
    }

    public function create()
    {
        $aviso = new JobAviso();
        $areaList = $this->areaService->dataList();
        $areaReferenciaList = $this->areaReferenciaService->dataList();
        $formacionReferenciaList = $this->formacionReferenciaService->dataList(['activo' => true]);
        $this->set('aviso', $aviso);
        $this->set('fuentes', AppParam::param('JOB_FUENTES')->options());
        $this->set('localizaciones', AppParam::param('P_LOCALIZACIONES_AVISO')->options());
        $this->set('nivelesFormacion', JobAviso::$nivelesFormacion);
        $this->set('areaReferenciaList', $areaReferenciaList);
        $this->set('formacionReferenciaList', $formacionReferenciaList);
        $this->set('areaList', $areaList);
//        $this->view->changeLayout('ajax');
    }

    public function save()
    {
        //if(PageControl::canCreate()){
        $data = Req::all();
        $data['FechaPublicacion'] = Req::_asDate('FechaPublicacion');
        $data['FechaVencimiento'] = Req::_asDate('FechaVencimiento');
        $data['AreasReferencia'] = Req::has('AreaReferencia') ?
            implode(";", Req::_('AreaReferencia')) : '';
        $data['FormacionesReferencia'] = Req::has('FormacionReferencia') ?
            implode(";", Req::_('FormacionReferencia')) : '';
        if (isset($_FILES['picture'])) {
            $data['picture'] = $_FILES['picture'];
        }
        $results = $this->avisoService->insertOrUpdate($data);
        $this->set('aviso', $results['object']);
        $this->set('success', $results['success']);
        $this->set('errors', $results['errors']);
        // }
        $this->renderAsJSON();
    }

    public function edit()
    {
        if (PageControl::canUpdate()) {
            $aviso = $this->objectIfExist();
            $areaList = $this->areaService->dataList();
            $areaReferenciaList = $this->areaReferenciaService->dataList();
            $formacionReferenciaList = $this->formacionReferenciaService->dataList(['activo' => true]);
            $this->set('aviso', $aviso);
            $this->set('fuentes', AppParam::param('JOB_FUENTES')->options());
            $this->set('localizaciones', AppParam::param('P_LOCALIZACIONES_AVISO')->options());
            $this->set('areaList', $areaList);
            $this->set('nivelesFormacion', JobAviso::$nivelesFormacion);
            $this->set('areaReferenciaList', $areaReferenciaList);
            $this->set('formacionReferenciaList', $formacionReferenciaList);
        }
//        $this->view->changeLayout('ajax');
    }

    public function update()
    {
        if (PageControl::canUpdate()) {
            $aviso = $this->objectIfExist();
            $data = Req::all();
            $data['FechaPublicacion'] = Req::_asDate('FechaPublicacion');
            $data['FechaVencimiento'] = Req::_asDate('FechaVencimiento');
            $data['AreasReferencia'] = Req::has('AreaReferencia') ?
                implode(";", Req::_('AreaReferencia')) : '';
            $data['FormacionesReferencia'] = Req::has('FormacionReferencia') ?
                implode(";", Req::_('FormacionReferencia')) : '';
            if (isset($_FILES['picture'])) {
                $data['picture'] = $_FILES['picture'];
            }
            $results = $this->avisoService->insertOrUpdate($data, $aviso);
            $this->set('aviso', $results['object']);
            $this->set('success', $results['success']);
            $this->set('errors', $results['errors']);
        }
        $this->renderAsJSON();
    }

    public function objectIfExist()
    {
        try {
            return $this->avisoService->findPk($this->id);
        } catch (ChocalaException $che) {
            HttpManager::responseAs404();
        }
    }

    public function delete()
    {
        if (PageControl::canDelete()) {
            $aviso = $this->objectIfExist();
            $this->avisoService->delete($aviso);
        }
        $this->redirectTo(['action' => 'dataList']);
    }

}