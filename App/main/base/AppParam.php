<?php

/**
 *
 * @author ypra
 * Date: 2/29/2016
 * Time: 9:42 p.m.
 */
abstract class AppParam
{

    const G_MAX_USER_SESSION_TIME = 'G_MAX_USER_SESSION_TIME';

    const G_MAX_USER_INCORRECT_LOGIN = 'G_MAX_USER_INCORRECT_LOGIN';

    const G_EMAIL_MAX_SENDING_TRIES = 'G_EMAIL_MAX_SENDING_TRIES';

    const G_EMAIL_TIME_BETWEEN_SEND = 'G_EMAIL_TIME_BETWEEN_SEND';

    const G_EMAIL_TRACKING_URI = 'G_EMAIL_TRACKING_URI';

    const G_PASSWORD_REQUEST_LIFE = 'G_PASSWORD_REQUEST_LIFE';

    const G_USER_ACCESS_URI = 'G_USER_ACCESS_URI';

    const E_MAX_AVAILABLE_USERS = 'E_MAX_AVAILABLE_USERS';

    const E_EMAIL_SALUTATION = 'E_EMAIL_SALUTATION';

    const U_SESSION_TIME = 'U_SESSION_TIME';

    /**
     * @var SysUser
     */
    private static $user;

    /**
     * @var SysEntity
     */
    private static $entity;

    /**
     * @param SysUser $user
     * @param SysEntity $entity
     */
    public function init(SysUser $user, SysEntity $entity)
    {
        self::$user = $user;
        self::$entity = $entity;
    }

    /**
     * @param $code
     * @return SysParam
     */
    public static function param($code)
    {
        return SysParamQuery::createValids()
                ->filterByCode($code)
            ->findOne();
    }

    /**
     * @param SysParam $param
     * @param SysUser $user
     * @return bool|DateTime|float|string
     */
    public static function userValue(SysParam $param, SysUser $user)
    {
        $userParam = $param->userParam($user);
        return is_object($userParam)? $userParam->value(): $param->value();
    }

    /**
     * @param SysParam $param
     * @param SysEntity $entity
     * @return bool|DateTime|float|string
     */
    public static function entityValue(SysParam $param, SysEntity $entity)
    {
        $entityParam = $param->userParam($entity);
        return is_object($entityParam)? $entityParam->value(): $param->value();
    }

    /**
     * @param string $code
     * @return bool|DateTime|float|string
     */
    public static function value($code)
    {
        $param = self::param($code);
        switch($param->getVisibility()){
            case SysParam::VISIBILITY_USER :
                return self::userValue($param, self::$user);
            case SysParam::VISIBILITY_ENTITY :
                return self::entityValue($param, self::$entity);
            case SysParam::VISIBILITY_GLOBAL :
            default:
                return $param->value();
        }
    }

}