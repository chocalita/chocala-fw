<?php
/**
 * Description of SystemController
 *
 * @author ypra
 */
class SystemController extends AdminWebController
{

    /**
     * @service SystemService Injected service
     * @var SystemService
     */
    protected $systemService;

    /**
     * @service admin.user.UserService Injected service
     * @var UserService
     */
    protected $userService;

    /**
     * @service system.email.EmailService Injected service
     * @var EmailService
     */
    protected $emailService;

    /**
     * @service system.emailSent.EmailSentService Injected service
     * @var EmailSentService
     */
    protected $emailSentService;

    /**
     * @service main.index.HolaService Injected Hola service
     * @var HolaService
     */
    protected $holaService;

    public function index()
    {
        $this->redirectTo(['action' => 'access']);
    }

    public function access()
    {
        SysUserQuery::create()->orderByUsername()->find();
    }

    public function naccess()
    {
    }
    
    public function login()
    {
        if(UserControl::login(Req::_('username'), Req::_('password'))){
            $this->redirectTo(['action' => 'main']);
        }else{
            $this->redirectTo(['action' => 'access']);
        }

    }

    public function logout()
    {
        // Any function to logout user account
        UserControl::logout();
        $this->redirectTo(['action' => 'index']);
    }

    public function main()
    {
        if(UserControl::hasRol('SUPER') || UserControl::hasRol('CODE')){
            $this->redirectTo(['action' => 'admin']);
        }else{
            $this->redirectTo(['action' => 'adminOther']);
        }
    }

    public function admin()
    {
        if(UserControl::isLoggedIn()){
            $this->set('user', UserControl::user());
            $this->view->changeLayout('private');
        }else{
            $this->redirectTo(['action' => 'access']);
        }
    }

    public function adminOther()
    {
        if(UserControl::isLoggedIn()){
            $this->set('user', UserControl::user());
            $this->view->changeLayout('private');
        }else{
            $this->redirectTo(['action' => 'access']);
        }
    }

    public function createdAccount()
    {
/*        $handler = curl_init("http://www.google.es");
        $response = curl_exec ($handler);
        curl_close($handler);
        echo $response; exit();*/
        if(is_object($this->sessionUser) && $this->sessionUser->hasCreatedStatus()){
            $this->set('user', $this->sessionUser);
        }else{
            $this->redirectTo(['action' => 'main']);
        }
    }

    public function changePassword()
    {
        $success = false;
        if(UserControl::isLoggedIn()){
            if(trim(Req::_('Password'))=='' || trim(Req::_('RPassword'))==''){
                $errors = 'Debe ingresar y repetir su nueva contraseña.';
            }else if(Req::_('Password') != Req::_('RPassword')){
                $errors = 'Debe repetir la nueva contraseña.';
            }else if(strlen(Req::_('Password'))<6){
                $errors = 'La contraseña es demasiado corta.';
            }else{
                $data['Password'] = Req::_('Password');
                $data['Status'] = SysUser::STATUS_ACTIVE;
                $results = $this->userService->insertOrUpdate($data, $this->sessionUser);
                $success = $results['success'];
                if($success){
                    $errors = 'Se cambió correctamente su password de usuario';
                }
            }
        }
        $this->set('success', $success);
        $this->set('errors', $errors);
        $this->renderAsJSON();
    }

    public function emailTracking()
    {
        try{
            $emailSent = $this->emailSentService->hashTracking($this->id);
        }catch (Exception $e){
            $emailSent = null;
        }
        $this->redirectTo(['url' => IMG_WEB.'divider-bar.png']);
    }

}