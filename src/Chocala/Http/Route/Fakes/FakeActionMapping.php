<?php

namespace Chocala\Http\Route\Fakes;

use Chocala\Base\DuplicateElementException;
use Chocala\Http\Mapping\ActionMapInterface;
use Chocala\Http\Route\ActionMapping;
use Chocala\Http\Route\ActionMappingInterface;
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