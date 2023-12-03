<?php

namespace Chocala\Http\Mapping;

use Chocala\Base\IllegalArgumentException;
use Chocala\Http\HttpMethod;
use Chocala\Http\HttpMethodEnum;
use Chocala\Http\Route\RoutesInterface;

class UriMapping implements UriMappingInterface
{

    /**
     * @var RoutesInterface
     */
    private RoutesInterface $routes;

    /**
     * UriMapping constructor.
     * @param RoutesInterface $routes
     */
    public function __construct(RoutesInterface $routes)
    {
        $this->routes = &$routes;
    }

    /**
     * Find the real URI in uriMapping.routes configuration, if it's not defined return the same value
     *
     * @param string $uri
     * @param HttpMethodEnum $method
     * @return string
     */
    public function realUri(string $uri, HttpMethodEnum $method): string
    {
        if ($uri === '') {
            return $uri;
        }
        $routes = $this->routes->routes();
        $patternRoutes = [];
        $foundRoute = array_key_exists($uri, $routes)? $routes[$uri]:  null;

        if ($foundRoute === null) {
            foreach ($routes as $kRoute => $vRoute) {
                if (strpos($kRoute, $uri) === 0) {
                    $foundRoute = $vRoute;
    //                if (is_array($vRoute)) {
    //                    foreach ($vRoute as $kMetho => $vURI) {
    //                        if (strtoupper($kMethod) == $method->name()) {
    //                            return $vURI;
    //                        }
    //                    }
    //                } else {
    //                    return $vRoute;
    //                }
                }
                if (strpos($kRoute, '{') !== false && strpos($kRoute, '}') !== false) {
                    $patternRoutes[$kRoute] = $vRoute;
                }
            }
        }
        if ($foundRoute === null) {
            foreach ($patternRoutes as $kRoute => $vRoute) {
                $valuesCharset = sprintf('{%s}', self::VALUES_CHARSET);
                $pRoute = preg_replace('/' . $valuesCharset . '/', self::VALUES_CHARSET, $kRoute);
                $found = preg_match('/' . str_replace('/', '\/', $pRoute) . '/i', $uri);
                if ($found) {
                    $foundRoute = $vRoute;
                }
            }
        }
        if ($foundRoute !== null) {
            if (is_array($foundRoute)) {
                foreach ($foundRoute as $kMethod => $vURI) {
                    if (strtoupper($kMethod) == $method->name()) {
                        return $vURI;
                    }
                }
            } else {
                return $foundRoute;
            }
        }
        return $uri;
    }

    private const VALUES_CHARSET = '([-_0-9a-zA-Z]+)?';

}
