<?php

use \Chocala\Base\Chocala;

Chocala::import("Model.utils.EmailSender");
//TODO: implements service injectons for another services
Chocala::import("Modules.system.email.EmailService");

/**
 * @author ypra
 * Date: 11/2/2016
 * Time: 4:48 PM
 *
 */
class UserService extends AuditService
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
     * @throws NotFoundException
     */
    public function findPk($pk)
    {
        $user = $this->validsQuery()->findPk($pk);
        if (!is_object($user)) {
            throw new NotFoundException(ChocalaErrors::INVALID_RESOURCE);
        }
        return $user;
    }

    /**
     * @param $email
     * @return SysUser
     */
    public function findOneByEmail($email)
    {
        return SysUserQuery::create()
            ->filterByUsername($email)
            ->filterByStatus(SysUser::STATUS_CLOSED, Criteria::NOT_EQUAL)
            ->findOne();
    }

    /**
     * @param array $filters
     * @return SysUser[]|\Propel\Runtime\Util\PropelModelPager
     */
    public function dataList($filters = [])
    {
        $query = $this->validsQuery()
            ->_if(isset($filters['email']))
            ->filterByEmail('%' . $filters['email'] . '%', Criteria::ILIKE)
            ->_endif()
            ->_if(isset($filters['username']))
            ->filterByUsername('%' . $filters['username'] . '%', Criteria::ILIKE)
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
                '%' . str_replace(' ', '%', $filters['completeName']) . '%')
            ->_or()
            ->where('CONCAT("%", SysPerson.FirstName, "%", COALESCE(SysPerson.MiddleName, "%"), "%",
                                     SysPerson.LastName, "%", COALESCE(SysPerson.SecondLastName, "%"), "%") LIKE ?',
                '%' . str_replace(' ', '%', $filters['completeName']) . '%')
            ->_endif()
            ->endUse()
            ->orderByUsername();
        $_page = $filters['_page'] ?: 1;
        $_max = $filters['_max'] ?: $query->count();
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
        if ($isNew) {
            $user = new SysUser();
            if (isset($data['RolId'])) {
                $usuarioXRol = new SysUserXRol();
                $usuarioXRol->setRolId($data['RolId']);
            }
        } else {
            $person = $user->person();
        }
        if (!is_object($person)) {
            $person = new SysPerson();
            $user->addSysPerson($person);
            $person->setSysUser($user);
        }
        if (isset($data['Password'])) {
            $data['Password'] = SysUser::crypt($data['Password']);
        }
        $user->fromArray($data);
        $person->fromArray($data);
        if ($isNew) {
            $user->setStatus(SysUser::STATUS_CREATED);
        }
//        $results['success'] = $user->validate() && $person->validate();
        $results['success'] = true;
        if ($results['success']) {
            $user->save();
            $person->save();
            if (is_object($usuarioXRol)) {
//                $usuarioXRol->setSysUser($user)->save();
            }
        }else{
            $user = null;
        }
        $results['object'] = $user;
        $results['errors'] = array_merge($user->getErrorsMap(), $person->getErrorsMap());
        return $results;
    }

    /**
     * @param SysUser $user
     * @return bool
     * @throws NotFoundException
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function sendPassword(SysUser $user)
    {
        $emailService = EmailService::instance();
        $email = $emailService->findByCode(SysUser::EMAIL_ACCOUNT_CREATION);
        $emailMap = [
            'To' => [
                ['Email' => $user->getEmail(), 'Name' => $user->person()->getFirstName()],
            ],
        ];
        $emailVars = [
            '~NOMBRE~' => $user->person()->getFirstName(),
            '~PASSWORD~' => SysUser::decrypt($user->getPassword()),
            '~ACCESS_LINK~' => WEB_ROOT . AppParam::value(AppParam::G_USER_ACCESS_URI),
        ];
        $emailSender = EmailSender::instanceFrom($email, $user);
        $emailSent = $emailSender->sendMail($emailMap, $emailVars);
        if (is_object($emailSent)) {
            return $emailSent->getIsSuccess();
        }
        return false;
    }

    /**
     * @param SysUser $user
     * @return bool
     * @throws NotFoundException
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function sendResetPassword(SysUser $user)
    {
        $hash = SpecialStrings::generateHash(20);
        $resetLink = WEB_ROOT . 'main/system/resetPassword/' . $hash;
        $emailService = EmailService::instance();
        $email = $emailService->findByCode(SysPasswordRequest::EMAIL_PASSWORD_REQUEST);
        $emailMap = [
            'TrackingHash' => $hash,
//            'From' => Config::_('email.info.address'),
//            'FromName' => Config::_('email.info.fromName'),
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
        if (is_object($emailSent)) {
            $passwordRequest = new SysPasswordRequest();
            $passwordRequest->setSysUser($user);
            $passwordRequest->setEmail($user->getEmail());
            $passwordRequest->setHashString($hash);
            $passwordRequest->setLifeTime(AppParam::value(AppParam::G_PASSWORD_REQUEST_LIFE));
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
        $originalCopy = $user->getId() . '_' . time() . '.' . FilesHelper::extension($filedata['name']);
        FilesHelper::copyInDir($filedata['tmp_name'], SysUser::PROFILE_DIR . '/original', $originalCopy);
        $user->setImageMime($filedata['type']);
        $imageObj = new Image($filedata);
        $results['success'] = $user->validate()
            && $imageObj->saveCropSquare($user->imageDir());
        if ($results['success']) {
            foreach (array_reverse(SysUser::$imageSizes) as $kSize => $vSize) {
                $imageObj->saveCropSquare($user->imageDir($kSize), $vSize);
            }
            $user->save();
        }
        $results['object'] = $user;
        $results['errors'] = $user->getErrorsMap();
        return $results;
    }

    /**
     * @param string $hashString
     * @return SysPasswordRequest
     */
    public function loadPasswordRequest($hashString)
    {
        $passwordRequest = SysPasswordRequestQuery::create()->findOneByHashString($hashString);
        if (is_object($passwordRequest) && $passwordRequest->getActive()) {
            // TODO: verify lifetime
            $passwordRequest->setAccededTimes($passwordRequest->getAccededTimes() + 1);
            $passwordRequest->save();
        }
        return $passwordRequest;
    }

    public function completePasswordRenew(SysPasswordRequest $passwordRequest, $newPassword)
    {
        $data['Password'] = UserControl::crypt($newPassword);
        $data['Status'] = SysUser::STATUS_ACTIVE;
        $passwordRequest->setActive(false);
        $passwordRequest->setRestoredIp($_SERVER['REMOTE_ADDR']);
        $passwordRequest->setRestoredDate(time());
        $passwordRequest->save();
        $results = $this->insertOrUpdate($data, $passwordRequest->getSysUser());
        if ($results['success']) {
            UserControl::login($passwordRequest->getSysUser()->getUsername(), $newPassword);
        }
        return $results;
    }

}