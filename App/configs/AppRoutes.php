<?php

namespace App\configs;

use Chocala\Route\RoutesInterface;
use Chocala\Route\Routing;

/**
 * Description of AppRoutes
 *
 * @author ypra
 */
class AppRoutes implements RoutesInterface
{
    use Routing;

    private $urlPattern = '/{module}/{controller}/{action}/{id}';

    private $mapping = [
        '' => ''
    ];

    private $routes = [
    ];

}