<?php
/**
 * Description of UserController
 *
 * @author ypra
 */
class UserController extends AdminWebController
{

    /**
     * @var UserService
     * @service UserService
     */
    protected $userService;

    public function index()
    {
        $this->redirectTo(['action'=>'dataList']);
    }

    public function dataList()
    {
        $filters = Req::all();
        $filters['_page'] = $filters['_page']?: 1;
        //$filters['_max'] = $filters['_max']?: 10;  //comment for all results
        $userPager = $this->userService->dataList($filters);
        $this->set('userPager', $userPager);
    }

    public function show()
    {
        $user = $this->userService->findPk($this->id);
        $this->set('user', $user);
        $this->set('person', $user->person());
    }

    public function create()
    {
        $rols = SysRolQuery::create()->orderByName()->find();
        $this->set('rols', $rols);
        $this->view->changeLayout('ajax');
    }

    public function save()
    {
        if(PageControl::canCreate()){
            $data = Req::all();
            $data['Password'] = SpecialStrings::generateHash(8);
            $data['Location'] = Req::_('City');
            $data['DateOfBirth'] = Req::_asDate('DateOfBirth');
            $results = $this->userService->insertOrUpdate($data);
            $user = $results['object'];
            if($results['success']){
                $sent = $this->userService->sendPassword($user);
            }
            if($results['success']){
                Flash::message('Se agregó correctamente al usuario.');
            }else{
                Flash::error('No se pudo registrar al usuario.');
            }
            $this->set('success', $results['success']);
            $this->set('errors', $results['errors']);
            $this->set('user', $user);
            $this->set('sent', $sent);
        }
        $this->renderAsJSON();
    }
    
    public function edit()
    {
        if(PageControl::canUpdate()){
            $user = $this->userService->findPk($this->id);
            $this->set('user', $user);
            $this->set('person', $user->person());
        }
        $this->view->changeLayout('ajax');
    }

    public function update()
    {
        if(PageControl::canUpdate()){
            $user = $this->userService->findPk($this->id);
            $data = Req::all();
            $data['Location'] = Req::_('City');
            $data['DateOfBirth'] = Req::_asDate('DateOfBirth');
            $results = $this->userService->insertOrUpdate($data, $user);
            if($results['success']){
                Flash::message('Se actualizaron correctamente los datos.');
            }else{
                Flash::error('No se pudieron actualizar los datos.');
            }
            $this->set('success', $results['success']);
            $this->set('errors', $results['errors']);
            $this->set('user', $user);
        }
        $this->renderAsJSON();
    }

    public function rolAdd()
    {
        $user = SysUserQuery::create()->findPk($this->id);
        $availableRols = SysRolQuery::create()
                ->filterById(array_map(function($item){
                    return $item->getId();
                }, $user->inOrderRols()->getArrayCopy()), Criteria::NOT_IN)
                ->find();
        $this->set('user', $user);
        $this->set('availableRols', $availableRols);
        $this->view->changeLayout('ajax');
    }

    public function rolSave()
    {
        $userRol = new SysUserXRol();
        $userRol->fromArray(Req::all());
        $success = $userRol->validate();
        if($success){
            $userRol->save();
            Flash::success('Se asignó correctamente el rol al usuario');
        }
        $this->set('success', $success);
        $this->set('errors', $userRol->getErrorsMap());
        $this->set('userRol', $userRol);
        $this->renderAsJSON();
    }

    public function rolDelete()
    {
        $user = SysUserQuery::create()->findPk($this->id);
        $userRol = SysUserXRolQuery::create()->findPk([$this->id, Req::_('rolId')]);
        $userRol->delete();
        Flash::error('Se quitó correctamente el Rol al Usuario');
        $this->redirectTo(['uri' => 'admin/user/show/' .$this->id]);
    }

    public function profileImageForm()
    {
        if (PageControl::canUpdate()) {
            $user = $this->sessionUser;
            $data = Req::all();
            $data['Location'] = Req::_('City');
            $data['DateOfBirth'] = Req::_asDate('DateOfBirth');
            unset($data['Email'], $data['Username'], $data['Password'], $data['Status']);
            $results = $this->userService->insertOrUpdate($data, $user);
            $this->set('user', $results['object']);
            $this->set('success', $results['success']);
            $this->set('errors', $results['errors']);
        }
        $this->view->changeLayout('ajax');
    }

    public function loadImage()
    {
        if(PageControl::canUpdate()) {
            $user = $this->sessionUser;
            $results = $this->userService->uploadProfileImage($_FILES['file'], $user);
            if($results['success']){
                Flash::message('Se cargó correctamente la imagen.');
            }else{
                Flash::error('No se pudo cargar la imagen.');
            }
            $this->set('user', $results['object']);
            $this->set('success', $results['success']);
            $this->set('errors', $results['errors']);
        }
        $this->renderAsJSON();
    }

    public function changeStatus()
    {
        if(PageControl::canUpdate()) {
            $user = $this->userService->findPk($this->id);
            $this->set('user', $user);
            $this->set('statusMap', SysUser::statusMap(Configs::value('app.run.lang')));
        }
        $this->view->changeLayout('ajax');
    }

    public function saveStatus()
    {
        if(PageControl::canUpdate()){
            $user = $this->userService->findPk($this->id);
            $data['Status'] = Req::_('Status');
            $results = $this->userService->insertOrUpdate($data, $user);
            $this->set('success', $results['success']);
            $this->set('errors', $results['errors']);
        }
        $this->renderAsJSON();
    }

    public function resetPassword()
    {
        if(PageControl::canUpdate()) {
            $user = $this->userService->findPk($this->id);
            $this->set('user', $user);
        }
        $this->view->changeLayout('ajax');
    }

    public function sendRequestPassword()
    {
        if(PageControl::canUpdate()) {
            $user = $this->userService->findPk($this->id);
            $success = $this->userService->sendResetPassword($user);
            if($success){
                Flash::message('Se envió correctamente el correo de restauración de acceso.');
            }else{
                Flash::error('No se pudo completar el envío de restauración de acceso.');
            }
            $this->set('user', $user);
            $this->set('success', $success);
        }
        $this->view->changeLayout('ajax');
    }

    public function profile()
    {
        $this->set('user', $this->sessionUser);
        $this->set('person', $this->sessionUser->person());
    }

    public function editProfile()
    {
        if(PageControl::canUpdate()){
            $user = $this->sessionUser;
            $this->set('user', $user);
            $this->set('person', $user->person());
        }
        $this->view->changeLayout('ajax');
    }

    public function updateProfile()
    {
        if(PageControl::canUpdate()){
            $user = $this->sessionUser;
            $data = Req::all();
            $data['Location'] = Req::_('City');
            $data['DateOfBirth'] = Req::_asDate('DateOfBirth');
            unset($data['Email'], $data['Username'], $data['Password'], $data['Status']);
            $results = $this->userService->insertOrUpdate($data, $user);
            if($results['success']){
                Flash::message('Se actualizaron correctamente el perfil de usuario.');
            }else{
                Flash::error('No se pudieron actualizar el perfil de usuario.');
            }
            $this->set('user', $results['object']);
            $this->set('success', $results['success']);
            $this->set('errors', $results['errors']);
        }
        $this->renderAsJSON();
    }

}