<?php

use \App\model\app\AuditLog;
use \Chocala\Base\WebController;
use \Chocala\Behavior\Logging;

/**
 * Description of AdminWebController
 *
 * @author ypra
 */
abstract class AdminWebController extends WebController
{
    use AuditLog, Logging;

    /**
     * @var SysUser
     */
    protected $sessionUser = null;

    public function _init()
    {
        $this->view->changeLayout('private');
        $this->sessionUser = UserControl::user();
        if (!is_object($this->sessionUser)) {
            $this->redirectTo(['uri' => 'main/system/login']);
        }
    }

}