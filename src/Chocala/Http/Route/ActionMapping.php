<?php

namespace Chocala\Http\Route;

use Chocala\Base\DuplicateElementException;
use Chocala\Http\Mapping\ActionMapInterface;
use Chocala\Http\Mapping\PatternMap;

class ActionMapping implements ActionMappingInterface
{

    private $patternMap;

    public function __construct(RoutesInterface $routes)
    {
        $this->patternMap = new PatternMap();
    }

    /**
     * @param string $uri
     * @return ActionMapInterface
     * @throws \Exception
     */
    public function actionMap(string $uri): ActionMapInterface
    {
        $matchCase = $this->matchCase($uri);
        if (empty($matchCase)) {
            $uriParts = array_map(function ($uriPart) {
                return "{" . $uriPart . "}";
            }, PatternMap::URI_STANDARD_PARTS);

            $patternMap = new PatternMap($this->routing->urlPattern());
            $pattern = str_replace($uriParts, self::VALUES_CHARSET, $patternMap->pattern(), $nReplaces);
//            $pattern = str_replace('/', '\/', $pattern);

            $pattern = str_replace('/', '\/?', $pattern);
            $pos = strpos($pattern, "\/?");
            $pattern = substr_replace($pattern, '\/', $pos, 3);

            $t = preg_match_all('/^' . $pattern . '/i', $uri, $out, PREG_PATTERN_ORDER);
            if (!$t) {
                throw new \Exception("Mapping is wrong (default mapping)");
            }

            $patternMapIndexes = array_flip($patternMap->map());

            array_shift($out);
            $module = $out[$patternMapIndexes[PatternMap::MODULE]][0];
            $controller = $out[$patternMapIndexes[PatternMap::CONTROLLER]][0];
            $action = $out[$patternMapIndexes[PatternMap::ACTION]][0];
            $id = $out[$patternMapIndexes[PatternMap::ID]][0];
            $params = [];

            return new ActionMap($module, $controller, $action, $id, $params);
        }

    }


    /**
     * Matches uri input in all mapping cases defined in uriMapping.mapping
     *
     * @param string $uri
     * @return mixed|string
     * @throws \Exception
     */
    private function matchCase(string $uri)
    {
    }

}
