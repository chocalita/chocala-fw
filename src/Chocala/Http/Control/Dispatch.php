<?php

namespace Chocala\Http\Control;

use Chocala\Base\ClassCastException;
use Chocala\Http\Mapping\ActionMapInterface;
use Chocala\Http\Mapping\ActionMappingInterface;
use Chocala\Http\RequestInterface;
use Chocala\Http\Response\Exceptions\HttpMethodNotAllowedException;
use Chocala\Http\Response\Exceptions\HttpNotImplementedException;
use Chocala\Http\Response\Response;
use Chocala\Http\ResponseInterface;
use Chocala\Http\ServerInterface;
use Chocala\Web\ControllerInterface;

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

    /**
     * @var ActionMapInterface
     */
    private ActionMapInterface $actionMap;

    public function __construct(RequestInterface $request, ActionMappingInterface $actionMapping)
    {
        $this->request = $request;
        $this->actionMapping = $actionMapping;
        $this->actionMap = $this->actionMapping->actionMap($this->request->requestLine()->requestUri());
    }

    public function submit(): ResponseInterface
    {

        $module = $this->actionMap->module();
        $controllerName = ucfirst($this->actionMap->controller()) . 'Controller';
        $action = $this->actionMap->action();

        $controller = $this->controller($controllerName, $module);

        if ($controller->_isAllowedMethod($action, $this->request->requestLine()->method())) {
//            foreach(ChocalaFiltersManager::filters() as $filter){
//                $filter->beforeAction();
//            }

//            ChocalaPreprocessor::preprocessServices($controller);

            $controller->_init();

            if (!method_exists($controller, $action)) {
                throw new HttpNotImplementedException("'$controllerName' not implements '$action' action ");
            }

//            foreach(ChocalaFiltersManager::filters() as $filter){
//                $filter->afterAction();
//            }

            $actionResult = $controller->_callback($action);

            //isRendered is inside the controller->_process()
//            if (!$controller->isRendered()) {
//                $controller->renderView($this->controller . '.' . $this->action,
//                    $this->module);
//            }

            $afterProcessResponse = $actionResult;

//            foreach(ChocalaFiltersManager::filters() as $filter){
//                $filter->afterView();
//            }

            $afterFiltersResponse = $afterProcessResponse;

            return new Response(
                $afterFiltersResponse->status(),
                $afterFiltersResponse->headers(),
                $afterFiltersResponse->body()
            );
        } else {
            throw new HttpMethodNotAllowedException();
        }
    }

    private function controller(string $controllerName, string $moduleName): ControllerInterface
    {
        $namespace = '\\App\\Controllers';
        $fully_qualified_class_name = "$namespace\\$moduleName\\$controllerName";
        $controller = new $fully_qualified_class_name();
        if (!($controller instanceof ControllerInterface)) {
            throw new ClassCastException("$controllerName should be an implementation of 'ControllerInterface'");
        }
        return $controller;
    }
}
