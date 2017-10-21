<?php
/**
 *
 * @author ypra
 * Date: 1/23/2016
 * Time: 6:37 a.m.
 */
abstract class PublicWebController extends WebController
{

    public function _init()
    {
        $this->view->changeLayout('public');
    }

}