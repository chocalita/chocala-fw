<?php
/**
 * Description of UserStatusEnum
 *
 * @author ypra
 */
abstract class UserStatusEnum
{

    /** User with actived account */
    const ACTIVED = 'ACTIVED';

    /** User with blocked account */
    const BLOCKED = 'BLOQUED';

    /** User with closed account */
    const CLOSED = 'CLOSED';

    /** User with created account */
    const CREATED = 'CREATED';

    const IS_ACTIVED = 'ACTIVO';
    const IS_BLOCKED = 'BLOQUEADO';
    const IS_CLOSED = 'CERRADO';
    const IS_CREATED = 'CREADO';

    /**
     * Return a user status complete list
     * @return array
     */
    public static function enum($lang=null)
    {
        switch($lang){
            case 'ES':
                $userStatus = array(
                    self::ACTIVED => self::IS_ACTIVED,
                    self::BLOCKED => self::IS_BLOCKED,
                    self::CLOSED => self::IS_CLOSED,
                    self::CREATED => self::IS_CREATED);
                break;
            default:
                $userStatus = array(
                    self::ACTIVED => self::ACTIVED,
                    self::BLOCKED => self::BLOCKED,
                    self::CLOSED => self::CLOSED,
                    self::CREATED => self::CREATED);
                break;
        }
        return $userStatus;
    }

    /**
     * Return the name title for the language as $lang parameter
     * @param string $status
     * @param string $lang
     * @return string
     */
    public static function statusFrom($status, $lang=null)
    {
        $statuses = self::enum($lang);
        return $statuses[$status];
    }

    /**
     * @return array
     */
    public static function inactives()
    {
        return array(self::BLOCKED, self::CLOSED);
    }

}