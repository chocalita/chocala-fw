<?php

use App\model\security\UserControl;

use Chocala\System\Flash;
use Chocala\System\Req;

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

    public function _init()
    {
        $this->view->changeLayout('private');
        $this->sessionUser = UserControl::user();
    }

    public function index()
    {
        $this->redirectTo(['action' => 'access']);
    }

    public function access()
    {
        if(UserControl::isLoggedIn()) {
            $this->redirectTo(['action' => 'main']);
        }
    }

    public function naccess()
    {
    }

    public function login()
    {
        if (UserControl::login(Req::_('username'), Req::_('password'))) {
            $this->redirectTo(['action' => 'main']);
        } else {
            Flash::error("Datos de Acceso Inválidos.");
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
        if (UserControl::hasRol('SUPER') || UserControl::hasRol('CODE')) {
            $this->redirectTo(['action' => 'admin']);
        } else if (UserControl::hasRol('ENT_ADM')) {
            $this->redirectTo(['uri' => 'cliente/avisos']);
        } else {
            $this->redirectTo(['action' => 'adminOther']);
        }
    }

    public function admin()
    {
        if (UserControl::isLoggedIn()) {
            $this->set('user', UserControl::user());
            $this->view->changeLayout('private');
        } else {
            $this->redirectTo(['action' => 'access']);
        }
    }

    public function adminOther()
    {
        if (UserControl::isLoggedIn()) {
            $this->set('user', UserControl::user());
            $this->view->changeLayout('private');
        } else {
            $this->redirectTo(['action' => 'access']);
        }
    }

    public function createdAccount()
    {
        /*        $handler = curl_init("http://www.google.es");
                $response = curl_exec ($handler);
                curl_close($handler);
                echo $response; exit();*/
        if (is_object($this->sessionUser) && $this->sessionUser->hasCreatedStatus()) {
            $this->set('user', $this->sessionUser);
        } else {
            $this->redirectTo(['action' => 'main']);
        }
    }

    public function resetPassword()
    {
        $passwordRequest = $this->userService->loadPasswordRequest($this->id);
        if (!is_object($passwordRequest)) {
            $this->redirectTo(['action' => 'main']);
        }
        $this->set('passwordRequest', $passwordRequest);
    }

    public function resetPassword2()
    {
        $passwordRequest = $this->userService->loadPasswordRequest($this->id);
        $success = false;
        $errors = [];
        if (!is_object($passwordRequest)) {
            $this->redirectTo(['action' => 'main']);
        }
        if (!$passwordRequest->getActive()) {
            $errors = 'La solicitud de recuperación no esta vigente, intente solicitando nuevamente.';
        } else if (trim(Req::_('Password')) == '' || trim(Req::_('RPassword')) == '') {
            $errors = 'Debe ingresar su nueva contraseña y repetirla.';
        } else if (Req::_('Password') != Req::_('RPassword')) {
            $errors = 'Debe repetir la nueva contraseña.';
        } else if (strlen(Req::_('Password')) < 6) {
            $errors = 'La contraseña es demasiado corta.';
        } else {
            $results = $this->userService->completePasswordRenew($passwordRequest, Req::_('Password'));
            $success = $results['success'];
            if ($success) {
                $errors = 'Se cambió correctamente su password de usuario correctamente';
            }
        }
        $this->set('message', $errors);
        $this->set('passwordRequest', $passwordRequest);
        $this->set('success', $success);
        $this->set('errors', $errors);
        $this->renderAsJSON();
    }

    public function changePassword()
    {
        $success = false;
        $errors = [];
        if (UserControl::isLoggedIn()) {
            if (trim(Req::_('Password')) == '' || trim(Req::_('RPassword')) == '') {
                $errors = ['field' => 'Password', 'message' => 'Debe ingresar y repetir su nueva contraseña.'];
            } else if (Req::_('Password') != Req::_('RPassword')) {
                $errors = ['field' => 'RPassword', 'message' => 'La repetición no coincide con la nueva contraseña.'];
            } else if (strlen(Req::_('Password')) < 8) {
                $errors = ['field' => 'Password', 'message' => 'La contraseña es demasiado corta.'];
            } else {
                $data['Password'] = UserControl::crypt(Req::_('Password'));
                $data['Status'] = SysUser::STATUS_ACTIVE;
                $results = $this->userService->insertOrUpdate($data, $this->sessionUser);
                $success = $results['success'];
            }
        }
        $this->set('success', $success);
        $this->set('errors', $errors);
        $this->renderAsJSON();
    }

    public function emailTracking()
    {
        try {
            $emailSent = $this->emailSentService->hashTracking($this->id);
        } catch (Exception $e) {
            $emailSent = null;
        }
        $this->redirectTo(['url' => IMG_WEB . 'divider-bar.png']);
    }

    public function emailTrackingDirectorio()
    {
        try {
            Chocala::import('Modules.recursos.directorioDB.DirectorioDBService');
            $emailSent = DirectorioDBService::instance()->hashTracking($this->id);
        } catch (Exception $e) {
            $emailSent = null;
        }
        $this->redirectTo(['url' => IMG_WEB . 'divider-bar.png']);
    }

}