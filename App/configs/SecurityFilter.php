<?php

namespace App\configs;

use Chocala\Base\Chocala;

Chocala::import('Model.security.SecurityRegistry');

/**
 * Description of SecurityFilter
 *
 * @author ypra
 */
class SecurityFilter extends \Chocala\Base\ChocalaFilter
{

    private static $noControls = ['system' => '*'];

    private static $allowedOnCreatedAccount = [
        'system' => ['index', 'access', 'naccess', 'login', 'logout',
            'createdAccount', 'changePassword', 'resetPassword']
    ];

    public function beforeAction()
    {
        SecurityRegistry::instance();
        $toVerify = !array_key_exists($this->controllerName, self::$noControls);
        if ($toVerify) {
            if (is_array(self::$noControls[$this->controllerName])) {
                $toVerify = !in_array($this->actionName,
                    self::$noControls[$this->controllerName]);
            } else {
                $toVerify = !self::$noControls[$this->controllerName] == '*';
            }
        }
        if (UserControl::isLoggedIn() && UserControl::user()->hasCreatedStatus() &&
            !$this->allowedFor(self::$allowedOnCreatedAccount)
        ) {
            $this->redirectTo(['uri' => 'main/system/createdAccount']);
        }
        // To verify with PageControl
        if ($toVerify) {
            $pageControl = PageControl::instance();
            if ($pageControl->isRegistered() && !$pageControl->canRead()) {
                $this->redirectTo(array('uri' => 'main/system/naccess'));
            }
        }
    }

    public function afterAction()
    {
    }

    public function afterView()
    {
    }

    public function allowedFor($allowedHash)
    {
        $contollers = array_keys($allowedHash);
        if (in_array($this->controllerName, $contollers)) {
            if (is_array($allowedHash[$this->controllerName])) {
                return in_array($this->actionName, $allowedHash[$this->controllerName]);
            } else if ($allowedHash[$this->controllerName] == '*') {
                return true;
            } else if ($allowedHash[$this->controllerName] == $this->actionName) {
                return true;
            }
        }
        return false;
    }

}