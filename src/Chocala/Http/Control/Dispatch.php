<?php

namespace Chocala\Http\Control;

use Chocala\Http\Mapping\UriMappingInterface;
use Chocala\Http\RequestInterface;
use Chocala\Http\ResponseInterface;
use Chocala\Http\Route\ActionMapping;
use Chocala\Http\Route\ActionMappingInterface;
use Chocala\Http\ServerInterface;

class Dispatch implements ServerInterface
{

    /**
     * @var RequestInterface
     */
    private RequestInterface $request;


    /**
     * @var ActionMappingInterface
     */
    private ActionMappingInterface $actionMapping;

    public function __construct(RequestInterface $request, ActionMappingInterface $actionMapping)
    {
        $this->request = $request;
        $this->actionMapping = $actionMapping;
    }

    public function submit(RequestInterface $request): ResponseInterface
    {

        $actionMap = $this->actionMapping->

        $uri = $this->request->requestLine()->requestUri();




        // TODO: Implement submit() method.
    }

}
