<?php

namespace Chocala\Http\Route;

interface RoutesInterface
{

    /**
     * @return string
     */
    public function urlPattern();

    /**
     * @return array
     */
    public function mapping();

    /**
     * @return array
     */
    public function routes();

}