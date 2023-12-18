<?php

namespace Chocala\Http\Route;

use Chocala\Base\DuplicateElementException;
use Chocala\Http\HttpMethod;
use Chocala\Http\Mapping\ActionMap;
use Chocala\Http\Mapping\ActionMapInterface;
use Chocala\Http\Mapping\PatternMap;
use Chocala\Http\Mapping\UriMapping;
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
     * @var HttpMethod
     *
     */
    private HttpMethod $method;

    public function __construct(RoutesInterface $routing, string $uri, string $method)
    {
        $this->routes = $routing;
        $this->uri = $uri;
        foreach (HttpMethod::all() as $m) {
            if ($m->name() == strtoupper($method)) {
                $this->method = $m;
            }
        }
    }

    /**
     * @return ActionMapInterface|null
     * @throws DuplicateElementException
     * @throws Exception
     */
    public function resolvedUri() : ?ActionMapInterface
    {
        $uri = (new RoutesMapping($this->routes))->realUri($this->uri, $this->method);
        $matchCase = (new UriMapping($this->routes))->matchCase($uri);
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
                $module = $vMatched[PatternMap::MODULE];
                $controller = $vMatched[PatternMap::CONTROLLER];
                $action = $vMatched[PatternMap::ACTION];
                $id = key_exists(PatternMap::ID, $vMatched)? $vMatched[PatternMap::ID]: null;
                $params = [];

                return new ActionMap($module, $controller, $action, $id, $params);

            } else if (is_string($vMatched)) {

            }
        }
        return null;
    }

}