<?php

/**
 *
 * @author: ypra
 * Date: 1/10/2018
 * Time: 22:16
 */
trait Logging
{

    /**
     * @return Logger
     */
    protected function _logger()
    {
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

        $this->_logger()->emergency($message, $context);
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
        $this->_logger()->alert($message, $context);
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
        $this->_logger()->critical($message, $context);
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
        $this->_logger()->error($message, $context);
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
        $this->_logger()->warning($message, $context);
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
        $this->_logger()->notice($message, $context);
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
        $this->_logger()->info($message, $context);
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
        $this->_logger()->debug($message, $context);
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
        $this->_logger()->log($level, $message, $context);
    }

}