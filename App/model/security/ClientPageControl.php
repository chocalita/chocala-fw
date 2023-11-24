<?php
require_once('PageControl.php');
/**
 * Description of ClientPageControl
 *
 * @author ypra
 */
class ClientPageControl extends PageControl
{
    public static function hasAccess()
    {
        if(parent::hasAccess()){
            $_SESSION[Param::_('SYSTEM_CODE').'Cliente'] = serialize(
            SycClientePeer::retrieveByPK(1));
            if(isset($_SESSION[Param::_('SYSTEM_CODE').'Cliente'])
                && is_object(unserialize($_SESSION[Param::_('SYSTEM_CODE')
                            .'Cliente']))){
                $sycCliente = unserialize($_SESSION[Param::_('SYSTEM_CODE')
                        .'Cliente']);
                define("ID_CLIENTE", $sycCliente->getClienteId());
                self::$user = User::createUser($sycCliente);
            }
//            print_r($sycCliente);
        }else{
            return false;
        }
    }
}