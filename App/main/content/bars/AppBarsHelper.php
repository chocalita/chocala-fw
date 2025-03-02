<?php
/**
 * This class is a helper that scope the variables for the bar renderization
 *
 * @author ypra
 */
class AppBarsHelper extends BarView
{

    public function myBar()
    {
        $this->set('myName', 'Yecid');
    }

    public function sidebar()
    {
        $user = UserControl::user();
        $userPages = UserControl::isLoggedIn()?
                PageControl::userPages($user, true): array();
        $this->set('user', $user);
        $this->set('userPages', $userPages);
        $this->set('page', PageControl::page());
    }

    public function menu_bootstrap()
    {
        $userPages = UserControl::isLoggedIn()?
                PageControl::userPages(UserControl::user(), true): array();
        $this->set('userPages', $userPages);
        $this->set('page', PageControl::page());
    }

}