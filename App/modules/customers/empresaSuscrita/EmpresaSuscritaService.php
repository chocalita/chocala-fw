<?php

/**
 * @author ypra
 * Date: 02/12/2017
 * Time: 10:19 PM
 *
 */
class EmpresaSuscritaService extends GenericService
{

    /**
     * @var EmpresaSuscritaService
     */
    protected static $instance = null;

    /**
     * @param bool $noDeletes
     * @return JobEmpresaSuscritaQuery
     */
    public function validsQuery($noDeletes = true)
    {
        return JobEmpresaSuscritaQuery::createValids($noDeletes);
    }

    /**
     * @param $pk
     * @return array|JobEmpresaSuscrita|mixed
     * @throws ChocalaException
     */
    public function findPk($pk)
    {
        $empresaSuscrita = $this->validsQuery()->findPk($pk);
        if (!is_object($empresaSuscrita)) {
            throw new ChocalaException(ChocalaErrors::INVALID_RESOURCE);
        }
        return $empresaSuscrita;
    }

    /**
     * @param $hashCode
     * @return JobEmpresaSuscrita
     * @throws ChocalaException
     */
    public function findByHashCode($hashCode)
    {
        $empresaSuscrita = JobEmpresaSuscritaQuery::create()->findOneByHashCode($hashCode);
        if (!is_object($empresaSuscrita)) {
            throw new ChocalaException(ChocalaErrors::INVALID_RESOURCE);
        }
        return $empresaSuscrita;
    }

    /**
     * @param array $filters
     * @return \Propel\Runtime\Util\PropelModelPager|JobEntidadSuscrita[]
     */
    public function dataList($filters = [])
    {
        $query = $this->validsQuery()
            ->_if(isset($filters['nit']))
            ->filterByNit('%' . $filters['nit'] . '%', Criteria::ILIKE)
            ->_endif()
            ->_if(isset($filters['nombre']))
            ->filterByNombre('%' . $filters['nombre'] . '%', Criteria::ILIKE)
            ->_endif()
            ->orderByNombre();
        $_page = $filters['_page'] ?: 1;
        $_max = $filters['_max'] ?: $query->count();
        return $query->paginate($_page, $_max);
    }

    /**
     * @param array $data
     * @param JobEmpresaSuscrita|null $empresaSuscrita
     * @return array mixed
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function insertOrUpdate($data, &$empresaSuscrita = null)
    {
        if (!is_object($empresaSuscrita)) {
            $hash = SpecialStrings::generateHash(20);
            $empresaSuscrita = new JobEmpresaSuscrita();
            $empresaSuscrita->setHashCode($hash);
        }
        $empresaSuscrita->fromArray($data);
        $results['success'] = $empresaSuscrita->validate();
        if ($results['success']) {
            $empresaSuscrita->save();
        }
        $results['object'] = $empresaSuscrita;
        $results['errors'] = $empresaSuscrita->getErrorsMap();
        return $results;
    }


    public function insertAndNotify(array $data)
    {
        // TODO: validate nombre completo de representante (por lo menos un espacio)
        $results = $this->insertOrUpdate($data);
        if ($results['success']) {
            $empresaSuscrita = $results['object'];
            $empresaSuscrita->save();
            // TODO: hash encrypt to base64 * 2
            $hashLink = $empresaSuscrita->getHashCode();
            $email = EmailService::instance()->findByCode(JobEmpresaSuscrita::EMAIL_SUBSCRIPTION);
//            $tmpArea = TmpAreaQuery::create()->findPk($suscriptor->getIdTmpArea());
//            print_r($suscriptor);
//            echo "\n Codigo : ";
//            echo $suscriptor->getIdTmpArea()."\n";
//            print_r($tmpArea); exit();
            $linkRegistro = WEB_ROOT . 'bolsa/trabajo/completar/' . $hashLink;
            $emailMap = [
                'TrackingHash' => $hash,
                'To' => [
                    ['Email' => $empresaSuscrita->getEmail(), 'Name' => $empresaSuscrita->getNombre()],
                ],
            ];
            $emailVars = [
                '~NOMBRE_SIMPLE~' => $empresaSuscrita->getNombre(),
                '~LINK_CONFIRMACION~' => $linkRegistro,
            ];
            $emailSent = EmailSender::instanceFrom($email)->sendMail($emailMap, $emailVars);
            $results['email'] = $emailSent->getToEmail();
        }
        return $results;
    }


    public static function logoFileExist($pkEntidad = ID_ENTITY)
    {
        return file_exists(PUBLIC_DIR . "images/imgEntidad/" . $pkEntidad . ".jpg");
    }

    public static function logoSrc($pkEntidad = ID_ENTITY)
    {
        if (!self::logoFileExist($pkEntidad)) {
            return IMG_WEB . "imgEntidad/empresa_default.jpg";
        } else {
            return IMG_WEB . "imgEntidad/" . $pkEntidad . ".jpg";
        }
    }

    public function rolAdministrador()
    {
        return SysRolQuery::create()->findOneByCode("ENT_ADM");
    }

    public function verifyUserAccount($data)
    {
        $results["success"] = false;
        // TODO: validate equals password
        $data['Password'] = SysUser::crypt($data['Password']);

        $rolAdmin = $this->rolAdministrador();
        $data['RolId'] = $rolAdmin->getId();

        $user = new SysUser();
        $usuarioXRol = new SysUserXRol();
        $usuarioXRol->setRolId($data['RolId']);
        $person = new SysPerson();
        $user->addSysPerson($person);
        $person->setSysUser($user);
        $user->fromArray($data);
        $person->fromArray($data);
        $user->setStatus(SysUser::STATUS_CREATED);

        $results['success'] = $person->validate() && $user->validate();
        if ($results['success'] && $data['Password'] != $data['Password2']) {
            $field = 'Password2';
            $messageKey = get_class($user) . '.' . $field . '.' . 'validate.password2';
            $message = __($messageKey, []);
            $results['success'] = false;
            $results['errors'] = [
                ['field' => $field, 'message' => $message]
            ];
            return $results;
        }
        if ($results['success']) {
            Session::set('personaSuscrita', $person);
            Session::set('usuarioSuscrito', $user);
            if (is_object($usuarioXRol)) {
//                $usuarioXRol->setSysUser($user)->save();
            }
        }
        $results['errors'] = $person->getErrorsMap();
        $results['success'] = true;
        return $results;
    }

    public function verifyAviso($data)
    {
        $data['Destacado'] = true;
        $data['FechaPublicacion'] = date('Y-m-d');
        $aviso = new JobAviso();
        $this->prepareInsert($aviso);
        $aviso->fromArray($data);
        $results['success'] = $aviso->validate();
        if ($results['success']) {
            Session::set('avisoSuscripcion', $aviso);
        }
        $results['errors'] = $aviso->getErrorsMap();
        return $results;

    }

}