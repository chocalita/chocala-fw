<?php

namespace Chocala\Presentation;

/**
 *
 * @author ypra
 */
interface IView
{

    public function changeLayout($layout);

    public function renderView($template, $module);

    public function setVar($nom, $var);

    public function setVars($vars);

}