<?php

/**
 * Description of AdminWebController
 *
 * @author ypra
 */
abstract class AdminWebController extends WebController
{

    /**
     * @var SysUser
     */
    protected $sessionUser = null;

    /**
     * @var SysEntity
     */
    protected $sessionEntity = null;

    public function _init()
    {
        $this->view->changeLayout('private');
        $this->sessionUser = UserControl::user();
        if (!is_object($this->sessionUser)) {
            $this->redirectTo(['uri' => 'main/system/login']);
        }
    }

}