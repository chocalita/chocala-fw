<?php
Chocala::import("Model.utils.EmailSender");
//TODO: implements service injectons for another services
Chocala::import("Modules.system.email.EmailService");

/**
 * @author ypra
 * Date: 11/2/2016
 * Time: 4:48 PM
 *
 */
class UserService extends GenericService
{

    /**
     * @var UserService
     */
    protected static $instance = null;

    /**
     * @return SysUserQuery
     */
    public function validsQuery()
    {
        return SysUserQuery::createValids();
    }

    /**
     * @param $pk
     * @return array|mixed|SysUser
     * @throws ChocalaException
     */
    public function findPk($pk)
    {
        $user = $this->validsQuery()->findPk($pk);
        if (!is_object($user)) {
            throw new ChocalaException(ChocalaErrors::INVALID_RESOURCE);
        }
        return $user;
    }

    /**
     * @param array $filters
     * @return SysUser[]|\Propel\Runtime\Util\PropelModelPager
     */
    public function dataList($filters=[])
    {
        $query = $this->validsQuery()
            ->_if(isset($filters['email']))
                ->filterByEmail('%'.$filters['email'].'%', Criteria::ILIKE)
            ->_endif()
            ->_if(isset($filters['username']))
                ->filterByUsername('%'.$filters['username'].'%', Criteria::ILIKE)
            ->_endif()
            ->_if(isset($filters['status']))
                ->filterByStatus($filters['status'])
            ->_endif()
            ->useSysPersonQuery()
                ->withColumn('CONCAT(SysPerson.LastName, " ", COALESCE(SysPerson.SecondLastName,""), " ",
                     SysPerson.FirstName, " ", COALESCE(SysPerson.MiddleName,""))', 'CompleteName')
                ->orderBy('CompleteName', 'asc')
                ->_if(isset($filters['completeName']))
                    ->where('CONCAT("%", SysPerson.LastName, "%", COALESCE(SysPerson.SecondLastName, "%"), "%",
                             SysPerson.FirstName, "%", COALESCE(SysPerson.MiddleName, "%"), "%") LIKE ?',
                        '%'.str_replace(' ', '%', $filters['completeName']).'%')
                    ->_or()
                    ->where('CONCAT("%", SysPerson.FirstName, "%", COALESCE(SysPerson.MiddleName, "%"), "%",
                             SysPerson.LastName, "%", COALESCE(SysPerson.SecondLastName, "%"), "%") LIKE ?',
                        '%'.str_replace(' ', '%', $filters['completeName']).'%')
                ->_endif()
            ->endUse()
            ->orderByUsername()
        ;
        $_page = $filters['_page']?: 1;
        $_max = $filters['_max']?: $query->count();
        return $query->paginate($_page, $_max);
    }

    /**
     * @param $data
     * @param SysUser|null $user
     * @return array|mixed
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function insertOrUpdate($data, SysUser &$user = null)
    {
        $person = null;
        $isNew = !is_object($user);
        $usuarioXRol = null;
        if($isNew){
            $user = new SysUser();
            if(isset($data['RolId'])){
                $usuarioXRol = new SysUserXRol();
                $usuarioXRol->setRolId($data['RolId']);
            }
        }else{
            $person = $user->person();
        }
        if(!is_object($person)){
            $person = new SysPerson();
            $user->addSysPerson($person);
            $person->setSysUser($user);
        }
        if(isset($data['Password'])){
            $data['Password'] = SysUser::crypt($data['Password']);
        }
        $user->fromArray($data);
        $person->fromArray($data);
        if($isNew){
            $user->setStatus(SysUser::STATUS_CREATED);
        }
        $results['success'] = $user->validate() && $person->validate();
        if ($results['success']) {
            $user->save();
            $person->save();
            if(is_object($usuarioXRol)){
//                $usuarioXRol->setSysUser($user)->save();
            }
        }
        $results['object'] = $user;
        $results['errors'] = array_merge($user->getErrorsMap(), $person->getErrorsMap());
        return $results;
    }

    /**
     * @param SysUser $user
     * @return bool
     * @throws ChocalaException
     */
    public function sendPassword(SysUser $user)
    {
        $emailService = EmailService::instance();
        $email = $emailService->findByCode(Sysuser::EMAIL_ACCOUNT_CREATION);
        $emailMap = [
            'To' => [
                ['Email' => $user->getEmail(), 'Name' => $user->person()->getFirstName()],
            ],
        ];
        $emailVars = [
            '~NOMBRE~' => $user->person()->getFirstName(),
            '~PASSWORD~' => SysUser::decrypt($user->getPassword()),
            '~ACCESS_LINK~' => WEB_ROOT. AppParam::value(AppParam::G_USER_ACCESS_URI),
        ];
        $emailSender = EmailSender::instanceFrom($email, $user);
        $emailSent = $emailSender->sendMail($emailMap, $emailVars);
        if(is_object($emailSent)){
            return $emailSent->getIsSuccess();
        }
        return false;
    }

    /**
     * @param SysUser $user
     * @return bool
     * @throws ChocalaException
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function sendResetPassword(SysUser $user)
    {
        $hash = SpecialStrings::generateHash(20);
        $resetLink = WEB_ROOT.'main/system/resetPassword/'.$hash;
        $emailService = EmailService::instance();
        $email = $emailService->findByCode(SysPasswordRequest::EMAIL_PASSWORD_REQUEST);
        $emailMap = [
            'TrackingHash' => $hash,
//            'From' => Configs::value('email.info.address'),
//            'FromName' => Configs::value('email.info.fromName'),
            'To' => [
                ['Email' => $user->getEmail(), 'Name' => $user->person()->getFirstName()],
            ],
//            'CC' => [
//                ['Email' => 'cc@email.com', 'Name' => 'Copy recipient'],
//            ],
//            'BCC' => [
//                ['Email' => 'bcc@email.com', 'Name' => 'Hiden recipient'],
//            ],
//            'Subject' => $email->getSubject(),
//            'Body' => $email->getBody(),
        ];
        $emailVars = [
            '~NOMBRE~' => $user->person()->getFirstName(),
            '~RESET_LINK~' => $resetLink,
        ];

        $emailSender = EmailSender::instanceFrom($email, $user);
        $emailSent = $emailSender->sendMail($emailMap, $emailVars);
        if(is_object($emailSent)){
            $passwordRequest = new SysPasswordRequest();
            $passwordRequest->setSysUser($user);
            $passwordRequest->setEmail($user->getEmail());
            $passwordRequest->setHashString($hash);
            $passwordRequest->setLifeTime(24);
            $passwordRequest->setRequestIp($_SERVER['REMOTE_ADDR']);
            $passwordRequest->save();
            return $emailSent->getIsSuccess();
        }
        return false;
    }

    /**
     * @param resource $filedata
     * @param SysUser $user
     * @return mixed
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function uploadProfileImage($filedata, SysUser &$user)
    {
        $originalCopy = $user->getId().'_'.time().'.'.FilesHelper::extension($filedata['name']);
        FilesHelper::copyInDir($filedata['tmp_name'], SysUser::PROFILE_DIR.'/original', $originalCopy);
        $user->setImageMime($filedata['type']);
        $imageObj = new Image($filedata);
        $results['success'] = $user->validate()
            && $imageObj->saveCropSquare($user->imageDir());
        if ($results['success']) {
            foreach(array_reverse(SysUser::$imageSizes) as $kSize => $vSize){
                $imageObj->saveCropSquare($user->imageDir($kSize), $vSize);
            }
            $user->save();
        }
        $results['object'] = $user;
        $results['errors'] = $user->getErrorsMap();
        return $results;
    }

}