<?php
require_once('SecurityRegistry.php');

/**
 * UserControlClass (Singleton Registered)
 * SINGLETON Pattern (SINGLETON REFACTORIZED)
 *
 * @author ypra
 */
class UserControl implements ISingleton
{

    /**
     *
     * @var SysUser
     */
    private static $sysUser = null;

    /**
     *
     * @var array
     */
    private static $sysRols = null;

    /**
     *
     * @return SysUser
     */
    public static function user()
    {
        return self::$sysUser;
    }

    /**
     *
     * @return array
     */
    public static function rols()
    {
        return self::$sysRols;
    }

    /**
     * 
     * @return UserControl
     */
    public static function instance()
    {
        return SecurityRegistry::instance()->userControl();
    }

    /**
     * 
     * @return string
     */
    public static function sessionVar()
    {
        return Configs::value('app.code').'_USER';
    }

    public function __construct()
    {
        $sessionVar = self::sessionVar();
        $sessionUser = Session::has($sessionVar)? Session::_($sessionVar): null;
        if(is_object($sessionUser)){
            self::$sysUser = $sessionUser;
            self::$sysUser->reload();
            self::$sysRols = SysRolQuery::create()
                    ->useSysUserXRolQuery()
                        ->filterBySysUser(self::$sysUser)
                    ->endUse()
                ->find();
            define("ID_USER", self::$sysUser->getId());
            $entidad = Session::_('entidad');
//            if(is_object($entidad)){
//                define("ID_ENTITY", $entidad->getId());
//            }
        }
    }

    /**
     * Crypt a string by a encryption method
     * @param string $string
     * @return string
     */
    public static function crypt($string)
    {
        /* TODO implements a encryption method*/
        $hash = $string;
        return $hash;
    }

    /**
     * Decrypt a string by a reverse encryption method
     * @param string $hash
     * @return string 
     */
    public static function decrypt($hash)
    {
        /* TODO implements a decryption method*/
        $string = $hash;
        return $string;
    }

    /**
     * Authenticate a user by login and password for signed in
     * @param string $username
     * @param string $password
     * @return boolean
     */
    public static function login($username, $password)
    {
        $sysUser = SysUserQuery::create()
                ->filterByUsername($username)
                ->filterByStatus(SysUser::inactives(), Criteria::NOT_IN)
            ->findOne();
        if(is_object($sysUser)){
            if($sysUser->getPassword() == self::crypt($password)){
                $sysUser->updateAccess();
                Session::set(self::sessionVar(), $sysUser);
                SecurityRegistry::instance()->updateRegistry('user', new UserControl());
                return true;
            } else {
                $sysUser->updateAccessFailures();
            }
        }
        return false;
    }

    /**
     * Signed out a user
     * @return boolean
     */
    public static function logout()
    {
        $sessionVar = self::sessionVar();
        if(Session::has($sessionVar)){
            Session::delete($sessionVar);
            return true;
        }
        return false;
    }

    /**
     * Verify the login of a user of the system
     * @return bool
     */
    public static function loginVerify()
    {
        if(is_object(self::$sysUser)){
            return true;
        }elseif(Post::has('username') && Post::has('password')
            && Post::_('username') != ""){
            self::login(Post::_('username'), Post::_('password'));
            header('Location: '.$_SERVER['HTTP_REFERER']);
            exit();
        }elseif(req::_('logout') != ""){
            self::logout();
            header('Location: '.WEB_ROOT);
            exit();
        }else{
            if(realpath($_SERVER['SCRIPT_FILENAME']) != PUBLIC_DIR."index.php"){
                header('Location: '.WEB_ROOT);
                return false;
            }
        }
    }

    /**
     * 
     * @return boolean
     */
    public static function isLoggedIn()
    {
        return is_object(UserControl::user());
    }

    /**
     * @param $rolCode
     * @return bool
     */
    public static function hasRol($rolCode)
    {
        return sizeof(array_filter(self::$sysRols->getArrayCopy(), function($obj) use($rolCode){
            return $obj->getCode() == $rolCode;
        }))>0;
    }

}