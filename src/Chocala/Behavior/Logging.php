<?php

namespace Chocala\Behavior;

use Psr\Log\LoggerInterface;

/**
 *
 * @author: ypra
 * Date: 1/10/2018
 * Time: 22:16
 */
trait Logging
{
    /**
     * @return LoggerInterface
     */
    protected function _logger()
    {
//        return GlobalObjectResources::instance()->resource(Application::LOGGER);
        return Logger::instance();
    }

    /**
     * System is unusable.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function _logEmergency($message, array $context = array())
    {

        $this->_logger()->emergency($this->formatedMessage($message), $context);
    }

    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function _logAlert($message, array $context = array())
    {
        $this->_logger()->alert($this->formatedMessage($message), $context);
    }

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function _logCritical($message, array $context = array())
    {
        $this->_logger()->critical($this->formatedMessage($message), $context);
    }

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function _logError($message, array $context = array())
    {
        $this->_logger()->error($this->formatedMessage($message), $context);
    }

    /**
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function _logWarning($message, array $context = array())
    {
        $this->_logger()->warning($this->formatedMessage($message), $context);
    }

    /**
     * Normal but significant events.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function _logNotice($message, array $context = array())
    {
        $this->_logger()->notice($this->formatedMessage($message), $context);
    }

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function _logInfo($message, array $context = array())
    {
        $this->_logger()->info($this->formatedMessage($message), $context);
    }

    /**
     * Detailed debug information.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function _logDebug($message, array $context = array())
    {
        $this->_logger()->debug($this->formatedMessage($message), $context);
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function _log($level, $message, array $context = array())
    {
        $this->_logger()->log($level, $this->formatedMessage($message), $context);
    }

    private function formatedMessage($message)
    {
        return '[' . get_called_class() . '] ' . $message;
    }
}
