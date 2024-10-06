<?php

namespace Chocala\Web;

use Chocala\Http\HttpMethodEnum;
use Chocala\Http\Response\Exceptions\HttpResponseException;
use Chocala\Web\Result\ActionResult;
use Chocala\Web\Result\ActionResultInterface;
use Chocala\Web\Result\ActionBodyInterface;
use Chocala\Web\Result\ActionDataInterface;
use Chocala\Web\Result\PrintActionBody;
use Exception;

trait ControllerTrait
{

    protected array $_allowedMethods = [];

    protected ActionDataInterface $_data;

    protected ActionBodyInterface $_actionBody;

    protected ActionResultInterface $_actionResult;

    protected bool $_isProcessed = false;

    final public function _isAllowedMethod(string $action, HttpMethodEnum $method): bool
    {
        if (isset($this->_allowedMethods[$action])) {
            $value = strtoupper(trim($this->_allowedMethods[$action]));
            return $value == $method->name() || $value == '*';
        }
        return true;
    }

    final public function _bodyAs(ActionBodyInterface $actionBody): void
    {
        $this->_actionBody = $actionBody;
    }

    /**
     * Generates content for the Response
     *
     * @param string $actionName
     * @return ActionResultInterface
     * @throws HttpResponseException
     * @throws Exception
     */
    final public function _callback(string $actionName): ActionResultInterface
    {
        if (!$this->_isProcessed) {
            try {
                $this->$actionName();
                $bodyContent = $this->_actionBody->result($this->_data);
                return new ActionResult($this->_actionResult, $bodyContent);
            } catch (HttpResponseExceptionInterface $e) {
                $this->_bodyAs(new PrintActionBody());
            } catch (Exception $e) {
                // TODO: improve this expecting HttpExceptions
                throw $e;
            } finally {
                $this->_isProcessed = true;
            }
        }
        throw new DuplicatedRenderException();
    }

}