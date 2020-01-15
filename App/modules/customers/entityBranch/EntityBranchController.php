<?php
/**
 * Description of EntityController
 *
 * @author ypra
 */
class EntityBranchController extends AdminWebController
{

    /**
     * @var EntityBranchService Injected service
     * @service EntityBranchService
     */
    protected $entityBranchService;

    /**
     * @var EntityService Injected service
     * @service customers.entity.EntityService
     */
    protected $entityService;

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
        $entityPager = $this->entityBranchService->dataList($filters);
        $this->set('entityPager', $entityPager);
    }

    public function show()
    {
        $entity = $this->entityBranchService->findPk($this->id);
        $this->set('entity', $entity);
        $this->set('mainBranch', $entity->mainBranch());
    }

    public function create()
    {
        $entity = $this->entityService->findPk($this->id);
        $locationList = $this->locationService->dataList();
        $this->set('locationList', $locationList);
        $this->set('entity', $entity);
        $this->view->changeLayout('ajax');
    }

    public function save()
    {
        if(PageControl::canCreate()){
            $data = Req::all();
            $data['Code'] = Req::_('Nit');
            $results = $this->entityBranchService->insertOrUpdate($data);
            $this->set('entityBranch', $results['object']);
            $this->set('success', $results['success']);
            $this->set('errors', $results['errors']);
        }
        $this->renderAsJSON();
    }

    public function edit()
    {
        if(PageControl::canUpdate()){
            $entityBranch = $this->entityBranchService->findPk($this->id);
            $locationList = $this->locationService->dataList();
            $this->set('locationList', $locationList);
            $this->set('entityBranch', $entityBranch);
        }
        $this->view->changeLayout('ajax');
    }

    public function update()
    {
        if(PageControl::canUpdate()){
            $entityBranch = $this->entityBranchService->findPk($this->id);
            $results = $this->entityBranchService->insertOrUpdate(Req::all(), $entityBranch);
            $this->set('entityBranch', $results['object']);
            $this->set('success', $results['success']);
            $this->set('errors', $results['errors']);
        }
        $this->renderAsJSON();
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