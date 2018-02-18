<?php
/**
 * Description of EmpresaSuscritaController
 *
 * @author ypra
 * Date: 02/12/2017
 * Time: 10:19 PM
 */
class EmpresaSuscritaController extends AdminWebController
{

    /**
     * @var EmpresaSuscritaService Injected service
     * @service EmpresaSuscritaService
     */
    protected $empresaSuscritaService;

    /**
     * @var EntityTypeService Injected service
     * @service customers.entityType.EntityTypeService
     */
    protected $entityTypeService;

    /**
     * @var LocationService Injected service
     * @service system.location.LocationService
     */
    protected $locationService;

    public function index()
    {
        $this->redirectTo(['action' => 'dataList']);
    }

    public function dataList()
    {
        $filters = Req::all();
        $filters['_page'] = $filters['_page']?: 1;
//        $filters['_max'] = $filters['_max']?: 20;  //comment for all results
        $entityPager = $this->empresaSuscritaService->dataList($filters);
        $this->set('entityPager', $entityPager);
    }

    public function show()
    {
        $entity = $this->objectIfExist();
        $this->set('entity', $entity);
        $this->set('mainBranch', $entity->mainBranch());
    }

    public function create()
    {
        $entity = new SysEntity();
        $entityTypeList = $this->entityTypeService->dataList();
        $locationList = $this->locationService->dataList();
        $this->set('entityTypeList', $entityTypeList);
        $this->set('locationList', $locationList);
        $this->set('entity', $entity);
        $this->view->changeLayout('ajax');
    }

    public function save()
    {
        if(PageControl::canCreate()){
            $data = Req::all();
            $data['Code'] = Req::_('Nit');
            $results = $this->empresaSuscritaService->insertOrUpdate($data);
            $this->set('entity', $results['object']);
            $this->set('success', $results['success']);
            $this->set('errors', $results['errors']);
        }
        $this->renderAsJSON();
    }

    public function edit()
    {
        if(PageControl::canUpdate()){
            $entity = $this->objectIfExist();
            $entityTypeList = $this->entityTypeService->dataList();
            $locationList = $this->locationService->dataList();
            $this->set('entityTypeList', $entityTypeList);
            $this->set('locationList', $locationList);
            $this->set('entity', $entity);
        }
        $this->view->changeLayout('ajax');
    }

    public function update()
    {
        if(PageControl::canUpdate()){
            $entity = $this->objectIfExist();
            $results = $this->empresaSuscritaService->insertOrUpdate(Req::all(), $entity);
            $this->set('entity', $results['object']);
            $this->set('success', $results['success']);
            $this->set('errors', $results['errors']);
        }
        $this->renderAsJSON();
    }

    public function objectIfExist()
    {
        try {
            return $this->empresaSuscritaService->findPk($this->id);
        } catch (ChocalaException $che) {
            HttpManager::responseAs404();
        }
    }

    public function loadArchivoImg()
    {
        $hoy = date('Y-m-d');
        $nombreDirectorio = "";
        $nombreFichero = "";
        if (is_uploaded_file($_FILES['archivoImg']['tmp_name'])) {
            $nombreDirectorio = PUBLIC_DIR . 'images/imgEntidad/';

            $idUnico = ID_ENTITY;
            $nombreFichero = $nombreFichero . $idUnico . ".jpg";
            move_uploaded_file($_FILES['archivoImg']['tmp_name'],
                $nombreDirectorio . $nombreFichero);
        }
        $this->set('dirFichero', IMG_WEB.'imgEntidad/'.$nombreFichero);
        $this->view->changeLayout('ajax');
        $this->renderAsJSON();
    }

} 