<?php

namespace Chocala\Http\Mapping;

interface ActionMapInterface
{

    /**
     * @return string
     */
    public function module();

    /**
     * @return string
     */
    public function controller();

    /**
     * @return string
     */
    public function action();

    /**
     * @return mixed
     */
    public function id();

    /**
     * @return array
     */
    public function params();

}