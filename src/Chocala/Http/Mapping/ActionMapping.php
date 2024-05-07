<?php

namespace Chocala\Http\Mapping;

use Chocala\Base\DuplicateElementException;
use Chocala\Base\NotFoundException;
use Chocala\Http\Route\RoutesInterface;
use Exception;

class ActionMapping implements ActionMappingInterface
{
    private const VALUES_CHARSET = '([-_0-9a-zA-Z]+)?';

    /**
     * @var PatternMapInterface
     */
    private PatternMapInterface $patternMap;

    /**
     * @var UriMappingInterface
     */
    private UriMappingInterface $uriMapping;

    public function __construct(RoutesInterface $routing)
    {
        $this->patternMap = new PatternMap($routing->urlPattern());
        $this->uriMapping = new UriMapping($routing);
    }

    /**
     * @param string $uri
     * @return ActionMapInterface
     * @throws DuplicateElementException
     * @throws Exception
     */
    public function actionMap(string $uri): ActionMapInterface
    {
        // TODO: extract only uri part
        $matchCase = $this->uriMapping->matchCase($uri);
        if (empty($matchCase)) {
            $uriParts = array_map(
                function ($uriPart) {
                    return '{' . $uriPart . '}';
                },
                PatternMap::URI_STANDARD_PARTS
            );

            $pattern = str_replace($uriParts, self::VALUES_CHARSET, $this->patternMap->pattern(), $nReplaces);
//            $pattern = str_replace('/', '\/', $pattern);
            $pattern = str_replace('/', '\/?', $pattern);
            $pos = strpos($pattern, '\/?');
            $pattern = substr_replace($pattern, '\/', $pos, 3);

            $t = preg_match_all('/^' . $pattern . '/i', $uri, $out, PREG_PATTERN_ORDER);
            if (!$t) {
                throw new Exception('Mapping is wrong (default mapping)');
            }

            $patternMapIndexes = array_flip($this->patternMap->map());

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
                $id = key_exists(PatternMap::ID, $vMatched) ? $vMatched[PatternMap::ID] : null;
                $params = [];

                return new ActionMap($module, $controller, $action, $id, $params);
            } elseif (is_string($vMatched)) {
            }
        }
        throw new NotFoundException('Uri is not matching with any mapped case.');
    }
}
