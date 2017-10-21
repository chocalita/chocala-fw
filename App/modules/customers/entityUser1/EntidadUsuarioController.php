<?php
/**
 * @author ypra
 * Date: 27/04/2015
 * Time: 03:25 PM
 */
class EntidadUsuarioController extends AccountingPrivateController
{

    /**
     * @var EntidadUsuarioService
     */
    private static $instance = null;

    /** @var $model EntidadUsuarioService */
    protected $model = null;

    /** @var $rolEntidadModel EntityRolService */
    protected $rolEntidadModel = null;

    public function _init()
    {
        parent::_init();
        $this->model = EntidadUsuarioService::instance();
        $this->rolEntidadModel = EntityRolService::instance();
    }

    public function index()
    {
        $usuarioList = ConSucursalQuery::create()
            ->filterByIdEntidad(ID_ENTITY)
            ->filterByEstado(EntidadUsuarioService::DELETED,Criteria::NOT_EQUAL)
            ->find();
        $this->set('sucursalList', $usuarioList);
    }

    public function tabla()
    {
        $this->view->UsernameFilter = Req::_('UsernameFilter');
        $this->view->NombreFilter = Req::_('NombreFilter');
        $this->view->IdSucursalFilter = Req::_('IdSucursalFilter');
        $this->view->EstadoFilter = Req::_('EstadoFilter');
        $usuariosList = $this->model->dataList(
            $this->view->UsernameFilter,
            $this->view->NombreFilter,
            $this->view->IdSucursalFilter,
            $this->view->EstadoFilter
        );
        $this->set('usuariosList', SysUser::statusMap('ES'));
        $this->set('usuariosList', $usuariosList);
        $this->view->changeLayout('ajax');
    }

    public function create()
    {

        $this->set('entidad', ConEntidadQuery::create()->findPk(ID_ENTITY));
        $this->set('rolEntidadList', $this->rolEntidadModel->dataList());
        $this->view->changeLayout('ajax');
    }

    public function save()
    {
        $entidad = ConEntidadQuery::create()->findPk(ID_ENTITY);
        $user = new SysUser();
        $user->setPassword(SpecialStrings::generatePassword());
        $user->setBirthDate(DateUtil::mysql(Req::_('birthday')));
        $user->setStatus(SysUser::CREATED);
        $rolEntidad = ConRolEntidadQuery::create()->findPk(
            Req::_('IdRolEntidad'));
        $user->fromArray(Req::all());
        $rol = $rolEntidad->getSysRol();
        $userRol = new SysUserXRol();
        $userRol->setSysRol($rol);
        $user->addSysUserXRol($userRol);
        $usuarioEntidad = new ConUsuarioEntidad();
        $usuarioEntidad->setConEntidad($entidad);
        $usuarioEntidad->setSysUser($user);
        $usuarioEntidad->setIdRolEntidad($rolEntidad->getId());
        $usuarioEntidad->setEstado(ChocalaBaseModel::ACTIVE);
        $usuarioEntidad->setCreacionFecha(time());
        $usuarioEntidad->setCreacionIdUsuario(UserControl::user()->getId());
        $usuarioEntidad->setModificacionFecha(time());
        $usuarioEntidad->setModificacionIdUsuario(UserControl::user()->getId());
        $user->addConUsuarioEntidad($usuarioEntidad);
//        $user->setPassword($user->getUsername());
        $success = $user->validate();
        if ($success && Validation::isEmail($user->getEmail())) {
            $user->save();
            $this->sendPassword($user);
        }
        $this->set('success', $success);
        $this->set('errors', $user->getErrorsMap());
        $this->set('userId', $user ? $user->getId() : '');
        $this->renderAsJSON();
    }

    public function edit()
    {
        $usuarioEntidad = ConUsuarioEntidadQuery::create()
            ->filterByIdEntidad(ID_ENTITY)
            ->filterByIdUsuario($this->id)
            ->findOne();
        $entidad = $usuarioEntidad->getConEntidad();
        $this->set('IdUsuarioEntidad', $usuarioEntidad->getId());
        $this->set('usuario', SysUserQuery::create()->findPk($usuarioEntidad->getIdUsuario()));
        $this->set('entidad', $entidad);
        $this->set('rolEntidadList', $this->rolEntidadModel->dataList());
        $this->view->changeLayout('ajax');
    }

    public function update()
    {
        if (PageControl::canUpdate()) {
//            print_r(Req::all());exit();
//            $data = Req::all();
//            $data['pk'] = Req::_('IdUsuario');
//            $this->model->saveOrUpdate($data);
            $user = $this->model->findPk(Req::_('IdUsuario'));
            $user->fromArray(Req::all());
            $user->setBirthDate(DateUtil::mysql(Req::_('birthday')));
            $usuarioEntidad = ConUsuarioEntidadQuery::create()
                    ->filterByIdEntidad(ID_ENTITY)
                    ->filterBySysUser($user)
                ->findOne();
            $usuarioEntidad->setModificacionFecha(time());
            $usuarioEntidad->setModificacionIdUsuario(UserControl::user()
                ->getId());
            $user->save();
            $usuarioEntidad->save();
            $rolEntidad = ConRolEntidadQuery::create()->findPk(
                Req::_('IdRolEntidad'));
        }
        $this->redirectTo(array('action' => 'index'));
    }

    public function delete()
    {
        if (PageControl::canDelete()) {
            $usuario =SysUserQuery::create()->findPk($this->id);
            if(is_object($usuario)){
                $usuarioEntidad = ConUsuarioEntidadQuery::create()
                    ->filterByIdEntidad(ID_ENTITY)
                    ->filterByIdUsuario($usuario->getId())
                    ->findOne();

                $suscriptor= ConSuscriptorQuery::create()
                    ->filterByEmail($usuario->getEmail())
                    ->findOne();

                if(is_object($usuarioEntidad)){
                    $usuarioEntidad->setEstado(EntidadUsuarioService::DELETED);
                    $usuarioEntidad->save();
                    $usuario->setStatus(SysUser::CLOSED);
                    $usuario->save();
                }
                if(is_object($suscriptor)){
                    $suscriptor->setEstado(SuscriptorModel::INICIADA);
                    $suscriptor->save();
                }
            }
        }
        $this->redirectTo(array('action' => 'index'));
    }

    public function searchFilter()
    {
        $term = Req::_('term');
        $dataFilter = Req::_('dataFilter');
        $usuarioList = SysUserQuery::create()
            ->useConUsuarioEntidadQuery()
            ->filterByEstado(EntidadUsuarioService::DELETED,Criteria::NOT_EQUAL)
            ->filterByIdEntidad(ID_ENTITY)
            ->endUse()
            ->where('SysUser.Username' . ' LIKE ?', '%' . $term . '%')
            ->find();

        $data = array();
        /**@var $usuarioInstance SysUser */
        foreach ($usuarioList as $usuarioInstance) {
            $dato = "";
            switch ($dataFilter) {
                case "Username":
                    $dato = $usuarioInstance->getUsername();
                    break;
                default:
                    $dato = "";
                    break;
            }
            $data[] = array(
                "id" => $usuarioInstance->getId(),
                "dato" => $dato,
                "username" => $usuarioInstance->getUsername()
            );
        }
        $this->set("datos", $data);
        $this->renderAsJSON();
    }

    public function verifyUsername()
    {
        $this->view->changeLayout('ajax');
        $usuarioOtro = SysUserQuery::create()->filterByUsername(strtolower(Req::_('username')))->findOne();
        $this->set('usuarioOtro', $usuarioOtro);
    }

    public function verifyEmail()
    {
        $this->view->changeLayout('ajax');
        $emailValido = Validation::isEmail(Req::_('email'));
        $usuarioOtro = $emailValido ? SysUserQuery::create()->filterByEmail(strtolower(Req::_('email')))->findOne() : null;
        $this->set('emailValido', $emailValido);
        $this->set('usuarioOtro', $usuarioOtro);
    }

    public function sendPassword(SysUser $user)
    {
        $results = array();
        $emailAddress = trim($user->getEmail());

        $_AutRes = 'suscripcionInterna';
        $emailService = null;
//        $emailService = new EmailService();
        $emailService->setFrom(Configs::value('accounting.subscription.email'));
        $emailService->setFromName(Configs::value('accounting.subscription.fromName'));
        $emailService->setSubject('Suscripción interna');
        $emailView = new EmailView();
        $emailContent = $emailView->renderView($_AutRes, '');
        $emailService->setBody($emailContent);
        $emailService->setTo($user->getEmail(), $user->completeName(false));
        $emailService->addVar('~NOMBRE~', $user->getFirstName());
        $emailService->addVar('~USUSARIO~', $user->getUsername());
        $emailService->addVar('~PASSWORD~', $user->getPassword());
        $emailService->processVars();
        $nSents = 0;
        $sent = false;
        while(!$sent && $nSents++ < 2){
            $sent = $emailService->run();
            sleep(1);
        }
        if(Configs::value('app.run.environment')=='development'){
            file_put_contents(PUBLIC_DIR.'email/suscripcionInterna-'.$user->getId().'.html', $emailService->content());
        }
            //return $sent;
//                $success = is_object($user);
//                $this->set('success', $success);
//                $this->set('errors', $success? $suscriptor: null);
    }
} 