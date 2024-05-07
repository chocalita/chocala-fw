<?php

namespace Chocala\Http\Route;

final class DefaultRoutes implements RoutesInterface
{
    use Routing;

    private string $urlPattern = '/{module}/{controller}/{action}/{id}';

    private array $mapping = [
        '/posts/{id}' => '/main/system/posts/{id}',
        '/author' => ['module' => 'main', 'controller' => 'index', 'system' => 'author'],
    ];

    private array $routes = [
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
