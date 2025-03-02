<?php


interface User
{

    /**
     * @param string $password
     * @return boolean
     */
    function verifyPassword($password);

    /**
     * @return User
     */
    function reload();

    /**
     * @return void
     */
    function updateAccessFailures();

    /**
     * @return void
     */
    function updateAccess();

}