<?php
/**
 * @author ypra
 * Date: 27/04/2015
 * Time: 03:25 PM
 */
class EntityUserController extends AdminWebController
{

    /**
     * @service admin.user.UserService Injected service
     * @var UserService
     */
    protected $userService;

    /**
     * @service admin.rol.RolService Injected service
     * @var RolService
     */
    protected $rolService;

    /**
     * @service customers.entity.EntityService Injected service
     * @var EntityService
     */
    protected $entityService;

    /**
     * @service EntityUserService Injected service
     * @var $entityUserService EntityUserService
     */
    protected $entityUserService = null;

    public function index()
    {
        $this->redirectTo(['action' => 'dataList']);
    }

    public function dataList()
    {

    }

    public function entity()
    {
        $entity = $this->entityService->findPk($this->id);
        $entityUsers = $this->entityUserService->dataList(['entityId' => $this->id]);
        $this->set('entity', $entity);
        $this->set('entityUsers', $entityUsers);
    }

    public function create()
    {
        $entity = $this->entityService->findPk($this->id);
        $rolPager = $this->rolService->dataList();
        $this->set('entity', $entity);
        $this->set('rolPager', $rolPager);
        $this->view->changeLayout('ajax');
    }

    public function save()
    {
        if(PageControl::canCreate()){
            $data = Req::all();
            $data['Code'] = Req::_('Nit');
            $results = $this->entityUserService->insertOrUpdate($data);
            $this->set('entity', $results['object']);
            $this->set('success', $results['success']);
            $this->set('errors', $results['errors']);
        }
        $this->renderAsJSON();
    }

    public function findUserJson(){

        $filters['completeName'] = Req::_('completeName');
        $filters['_max'] = 20;
        $users = $this->userService->dataList($filters);
        $this->set('users',$users);
        $this->renderAsJSON();
    }


}