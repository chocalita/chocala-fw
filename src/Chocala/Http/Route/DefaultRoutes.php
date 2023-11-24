<?php

namespace Chocala\Http\Route;

final class DefaultRoutes implements RoutesInterface
{
    use Routing;

    private $urlPattern = '/{module}/{controller}/{action}/{id}';

    private $mapping = [
        '/posts/{id}' => '/main/system/posts/{id}',
        '/author' => ['module' => 'main', 'controller' => 'index', 'system' => 'author'],
    ];

    private $routes = [
        '/' =>
            '/main/system/index',
        '/contact' =>
            '/main/system/contact',
        '/info' =>
            '/main/system/info',
        '/map' =>
            '/main/system/map'
    ];

}