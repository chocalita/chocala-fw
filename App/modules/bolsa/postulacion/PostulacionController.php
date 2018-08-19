<?php

/**
 * Description of SuscripcionesController
 *
 * @author rehb
 * Date: 05/01/2018
 * Time: 06:59 PM
 */
class PostulacionController extends PublicWebController
{

    /**
     * @var AuthService
     * @service main.auth.AuthService
     */
    protected $authService;

    /**
     * @var PostulanteService
     * @service bolsa.postulante.PostulanteService
     */
    protected $postulanteService;

    /**
     * @service admin.user.UserService Injected service
     * @var UserService
     */
    protected $userService;

    /**
     * @var PostulacionService Injected service
     * @service bolsa.postulacion.postulacionService
     */
    protected $postulacionService;

    public function index()
    {
        $this->postulacion();
        $this->view->renderView('bolsa.postulacion.postulacion');
        exit;
    }

    public function postulacion()
    {
        if (HttpManager::isAJAXRequest()) {
            $this->view->changeLayout('ajax');
        }
        $this->set('__Menu', $this->authService->getMenu($this->view));
        $aviso = $this->avisoIfExist();
        $this->set('idPostulacion', $aviso->getId());
        $this->set('aviso', $aviso->getDescripcion());
        $this->set('postulacionRegistrada', false);
        $this->set('captchaUrl', $this->postulacionService->createCaptcha());
        if(!is_object($aviso)){
            $this->redirectTo(['url' => '']);
        }
        if(UserControl::isLoggedIn() && $this->postulacionService->findPostulacionPorIdUsuario(UserControl::user()->getId(), $this->id)) {
            $this->view->renderView('bolsa.postulacion.registrado');
            exit;
        }
    }

    public function postularme()
    {
        $this->view->changeLayout('ajax');
        try{
            $this->set('status', "OK");
            if(UserControl::isLoggedIn()){
                if(Req::_('celular') == ""){
                    throw new Exception("Ingrese un número de celular válido.");
                }
            }else{
                if(Req::_('apellidos') == "" || Req::_('nombres') == ""
                    || Req::_('email') == "" || Req::_('celular') == ""){
                    throw new Exception("Ingrese los campos obligatorios.");
                }
            }
            if(!isset($_FILES['cv'])){
                throw new Exception("Adjunta tu curriculum vitae.");
            }
            if(!strstr($_FILES['cv']['type'], 'pdf') && !strstr($_FILES['cv']['type'], 'word')){
                throw new Exception("Archivos válidos PDF y WORD.");
            }
            if(!$this->postulacionService->verifyCaptcha(Req::_('captcha'))){
                throw new Exception("Verificación de captcha incorrecta, intenta otra vez.");
            }
            if(!UserControl::isLoggedIn()) {
                $user = $this->userService->findOneByEmail(Req::_('email'));
            }else{
                $user = UserControl::user();
            }
            if(!is_object($user)) {
                if(Req::_('password') == ""){
                    throw new Exception("Ingresa una contraseña.");
                }
                $aResult = $this->userService->insertOrUpdate([
                    "FirstName" => Req::_('nombres'),
                    "LastName" => Req::_('apellidos'),
                    "Email" => Req::_('email'),
                    "Username" => Req::_('email'),
                    "Password" => Req::_('password'),
                    "RolId" => 3,
                ]);
                $user = $aResult['object'];
                if(is_object($user)){
                    $aResult['object']->setStatus(SysUser::STATUS_ACTIVE)->save();
                    UserControl::login(Req::_('username'), Req::_('pass'));
                }
            }
            if(is_object($user)){
                $fileName = $user->getId() . "-" . Req::_('pk') . "-" . $_FILES['cv']['name'];
                if(is_uploaded_file($_FILES['cv']['tmp_name'])) {
                    move_uploaded_file($_FILES['cv']['tmp_name'], $this->postulacionService->getCvDir() . $fileName);
                }else{
                    throw new Exception("Tú curriculum no pudo ser guardado.");
                }
                Req::set("cvMime", $_FILES['cv']['type']);
                Req::set("cvFilename", $fileName);

                $this->postulacionService->savePostulacionPorUsuario($user, Req::_('pk'), Req::all());
                $this->set('status', "OK");
                $this->set('postulacionRegistrada', true);
                $this->set('message', "Tu postulación fue guardada correctamente");
            }
        }catch (Exception $e){
            $this->set('status', "ERROR");
            $this->set('message', $e->getMessage());
        }
        $this->renderAsJSON();
    }

    public function avisoIfExist()
    {
        try {
            return JobAvisoQuery::create()->findPk($this->id);
        } catch (ChocalaException $che) {
            HttpManager::responseAs404();
        }
    }

    public function changeCaptcha()
    {
        $this->set('captchaImageUrl', $this->postulacionService->createCaptcha());
        $this->renderAsJSON();
    }

} 