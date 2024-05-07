<?php

namespace Chocala\Http\Route\Fakes;

use Chocala\Base\DuplicateElementException;
use Chocala\Http\Mapping\ActionMapInterface;
use Chocala\Http\Mapping\ActionMapping;
use Chocala\Http\Mapping\ActionMappingInterface;
use Exception;

class FakeActionMapping implements ActionMappingInterface
{
    private ActionMappingInterface $actionMapping;

    public function __construct()
    {
        $this->actionMapping = new ActionMapping(new FakeRoutes());
    }

    /**
     * @param string $uri
     * @return ActionMapInterface
     * @throws DuplicateElementException
     * @throws Exception
     */
    public function actionMap(string $uri): ActionMapInterface
    {
        return $this->actionMapping->actionMap($uri);
    }
}
