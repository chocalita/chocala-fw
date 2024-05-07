<?php

namespace Chocala\Http\Mapping;

use Chocala\Base\DuplicateElementException;
use Chocala\Http\Route\RoutesInterface;

class UriMapping implements UriMappingInterface
{
    private const VALUES_CHARSET = '([-_0-9a-zA-Z]+)?';

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
     * Matches uri input in all mapping cases defined in uriMapping.mapping
     *
     * @param string $uri
     * @return array
     * @throws DuplicateElementException
     */
    public function matchCase(string $uri): array
    {
        $mapping = $this->routes->mapping();
        if (array_key_exists($uri, $mapping)) {
            return [$uri => $mapping[$uri]];
        }

        $uriParts = array_map(
            function ($uriPart) {
                return '{' . $uriPart . '}';
            },
            PatternMap::URI_STANDARD_PARTS
        );

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
