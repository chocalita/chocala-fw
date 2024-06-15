<?php

namespace Chocala\Http\Control;

use Chocala\Base\ClassCastException;
use Chocala\Http\Headers;
use Chocala\Http\Mapping\ActionMapInterface;
use Chocala\Http\Mapping\ActionMappingInterface;
use Chocala\Http\RequestInterface;
use Chocala\Http\Response\Exceptions\HttpMethodNotAllowedException;
use Chocala\Http\Response\Exceptions\HttpNotImplementedException;
use Chocala\Http\Response\Exceptions\HttpResponseException;
use Chocala\Http\Response\Exceptions\HttpResponseExceptionInterface;
use Chocala\Http\Response\Parts\ResponseHeaders;
use Chocala\Http\Response\Response;
use Chocala\Http\ResponseInterface;
use Chocala\Http\ServerInterface;
use Chocala\System\ContentType;
use Chocala\Web\ControllerInterface;
use Chocala\Web\Result\ResponseExceptionResult;
use Chocala\Web\Result\ResultHeaders;

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

            try {
                $actionResult = $controller->_callback($action);

                //isRendered is inside the controller->_process()
//            if (!$controller->isRendered()) {
//                $controller->renderView($this->controller . '.' . $this->action,
//                    $this->module);
//            }

                $afterProcessResponse = $actionResult;

            } catch (HttpResponseException $e) {
                $requestHeaders = $this->request->headers();
                $contentType = $this->request->headers()->header(Headers::CONTENT_TYPE_KEY);

                $e->message();
                $e->statusCode();

                $afterProcessResponse = new ResponseExceptionResult(
                    $e,
                    new ResultHeaders($requestHeaders->headersType(Headers::TYPE_GENERAL)),
                    $requestHeaders->header(Headers::CONTENT_TYPE_KEY)
                );
            }


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
