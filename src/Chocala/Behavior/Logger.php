<?php

namespace Chocala\Behavior;

use Monolog\Logger as Monolog;
use Monolog\Formatter\LineFormatter as LineFormatter;
use Monolog\Handler\StreamHandler as StreamHandler;

/**
 *
 * @author: ypra
 * Date: 1/10/2018
 * Time: 21:40
 */
class Logger implements \Psr\Log\LoggerInterface
{
    /**
     * @var \Monolog\Logger null
     */
    private $log = null;

    /**
     *
     * @return Logger
     */
    public static function instance()
    {
        return SecurityRegistry::instance()->logger();
    }

    public function __construct()
    {
        $this->log = new Monolog('ChocalaLogger');
        $formatter = new LineFormatter(
            "[%datetime%] %level_name% %message% %context% %extra%\n",
            'Y-m-d H:i:s',
            true,
            true
        );
        $debugHandler = new StreamHandler(CONFIGS_DIR . 'logs\app.log', Monolog::WARNING);
        $debugHandler->setFormatter($formatter);
        $this->log->pushHandler($debugHandler);
//        $this->log->pushHandler(new StreamHandler(CONFIGS_DIR . 'logs\app.log', Monolog::WARNING));
    }


    /**
     * System is unusable.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function emergency($message, array $context = array())
    {
        $this->log->emerg($message, $context);
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
    public function alert($message, array $context = array())
    {
        $this->log->alert($message, $context);
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
    public function critical($message, array $context = array())
    {
        $this->log->crit($message, $context);
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
    public function error($message, array $context = array())
    {
        $this->log->err($message, $context);
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
    public function warning($message, array $context = array())
    {
        $this->log->warn($message, $context);
    }

    /**
     * Normal but significant events.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function notice($message, array $context = array())
    {
        $this->log->notice($message, $context);
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
    public function info($message, array $context = array())
    {
        $this->log->info($message, $context);
    }

    /**
     * Detailed debug information.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function debug($message, array $context = array())
    {
        $this->log->debug($message, $context);
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
    public function log($level, $message, array $context = array())
    {
        $this->log->addRecord($level, $message, $context);
    }
}
