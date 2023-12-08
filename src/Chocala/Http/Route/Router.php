<?php

namespace Chocala\Http\Route;

use Chocala\Base\DuplicateElementException;
use Chocala\Http\Mapping\ActionMap;
use Chocala\Http\Mapping\PatternMap;
use Exception;

class Router
{

    private const VALUES_CHARSET = '([-_0-9a-zA-Z]+)?';

    /**
     * @var Routing
     */
    private $routes;

    /**
     * @var string
     */
    private string $uri;

    /**
     * @var string
     *
     */
    private string $method;

    public function __construct(RoutesInterface $routing, string $uri, string $method)
    {
        $this->routes = $routing;
        $this->uri = $uri;
        $this->method = strtoupper($method);
    }

    /**
     * @return ActionMap|null
     * @throws DuplicateElementException
     * @throws Exception
     */
    public function resolvedUri() : ?ActionMap
    {
        $uri = $this->realUri();
        $matchCase = $this->matchCase($uri);
        if (empty($matchCase)) {

            $uriParts = array_map(function ($uriPart) {
                return "{" . $uriPart . "}";
            }, PatternMap::URI_STANDARD_PARTS);

            $patternMap = new PatternMap($this->routes->urlPattern());
            $pattern = str_replace($uriParts, self::VALUES_CHARSET, $patternMap->pattern(), $nReplaces);

            $pattern = str_replace('/', '\/?', $pattern);
            $pos = strpos($pattern, "\/?");
            $pattern = substr_replace($pattern, '\/', $pos, 3);

            $t = preg_match_all('/^' . $pattern . '/i', $uri, $out, PREG_PATTERN_ORDER);
            if (!$t) {
                throw new Exception("Mapping is wrong (default mapping)");
            }

            $patternMapIndexes = array_flip($patternMap->map());

            array_shift($out);
            $module = $out[$patternMapIndexes[PatternMap::MODULE]][0];
            $controller = $out[$patternMapIndexes[PatternMap::CONTROLLER]][0];
            $action = $out[$patternMapIndexes[PatternMap::ACTION]][0];
            $id = $out[$patternMapIndexes[PatternMap::ID]][0];
            $params = [];

            return new ActionMap($module, $controller, $action, $id, $params);
        } else {
            $kMatched = array_key_first($matchCase);
            $vMatched = $matchCase[$kMatched];
            //TODO: find keywords in kMatched
            if (is_array($vMatched)) {

            } else if (is_string($vMatched)) {

            }
        }
        return null;
    }

    /**
     * Find the real URI in uriMapping.routes configuration, if it's not defined return the same value
     *
     * @return string
     */
    private function realUri(): string
    {
        $routes = $this->routes->routes();
        foreach ($routes as $kRoute => $vRoute) {
            if (strpos($kRoute, $this->uri) === 0) {
                if (is_array($vRoute)) {
                    foreach ($vRoute as $kMethod => $vURI) {
                        if (strtoupper($kMethod) == $this->method) {
                            return $vURI;
                        }
                    }
                } else {
                    return $vRoute;
                }
            }
        }
        return $this->uri;
    }

    /**
     * Matches uri input in all mapping cases defined in uriMapping.mapping
     *
     * @param string $uri
     * @return mixed|string
     * @throws DuplicateElementException
     */
    private function matchCase(string $uri)
    {
        $mapping = $this->routes->mapping();
        if (array_key_exists($uri, $mapping)) {
            return $mapping[$uri];
        }

        $uriParts = array_map(function ($uriPart) {
            return "{" . $uriPart . "}";
        }, PatternMap::URI_STANDARD_PARTS);

        $matches = [];
        foreach ($mapping as $kRouteCase => $vRouteCase) {
            $nReplaces = 0;
            $pattern = str_replace($uriParts, self::VALUES_CHARSET, $kRouteCase, $nReplaces);
            $pattern = str_replace('/', '\/', $pattern);

            $t = preg_match('/^' . $pattern . '/i', $uri, $out, PREG_OFFSET_CAPTURE);
            if ($t && sizeof($out) > 1) {
                if (array_key_exists($nReplaces, $matches)) {
                    throw new DuplicateElementException(sprintf("Illegal conflict to match case with mapping '%s'", $kRouteCase));
                }
                $matches[$nReplaces] = [$kRouteCase => $vRouteCase];
            }
        }
        if (sizeof($matches) > 0) {
            ksort($matches);
            return array_shift($matches);
        }
        return [];
    }

}