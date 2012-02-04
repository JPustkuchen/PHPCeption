<?php

/**
 * Default logging extension for PHPCeption.
 * Handles the logging of an exception handled by PHPCeption.
 * Optionally makes use of Zend_Log (http://framework.zend.com/manual/de/zend.log.html)
 * from Zend Framework as flexible method for logging Exceptions to
 * several destinations.
 * For basic logging functionality to error_log no further Libraries are needed.
 *
 * @author Julian Pustkuchen
 * @copyright Julian Pustkuchen - http://Julian.Pustkuchen.com
 * @license PHPCeption by Julian Pustkuchen is licensed under a Creative Commons Attribution-ShareAlike 3.0 Unported License. See LICENSE.txt
 */
class PHPCeption_Extensions_Log extends PHPCeption_Extensions_AbstractExtension
{

    /**
     * Enables / Disables the logging to
     * standard error log.
     * (Basic functionality
     * without any further frameworks needed!)
     *
     * @var bool
     */
    private $logToErrorlog = true;

    /**
     * Enables / Disables the log to Zend_Log.
     *
     * @var bool
     */
    private $logToZendLog = false;

    /**
     * The (if enabled) used Zend_Log object.
     * Available via Getters / Setters for possible
     * necessary modifications.
     *
     * @var Zend_Log
     */
    private $zendLog;

    /**
     * The Zend_Log_Writer object required if logging
     * to Zend_Log is enabled.
     * If several writers shell be used simultaneously,
     * provide them as array!
     *
     * @var Zend_Log_Writer|array<Zend_Log_Writer>
     */
    private $zendLogWriter = null;

    // Configuration hash keys!
    const KEY_CONFIG_LOGTOERRORLOG = 'log_to_errorlog';

    const KEY_CONFIG_LOGTOZENDLOG = 'log_to_zend_log';

    const KEY_CONFIG_ZENDLOGWRITER = 'zend_log_writer';

    /**
     * Returns a new instance.
     *
     * @param $e Exception
     * @param $configuration PHPCeption_Configuration
     *
     * @return PHPCeption_Notify
     */
    public static function createInstance (Exception $e,
            PHPCeption_Configuration $configuration)
    {
        return new self($e, $configuration);
    }

    protected function __construct (Exception $exception,
            PHPCeption_Configuration $configuration)
    {
        parent::__construct($exception, $configuration);
        // Set configuration data if present.
        if ($configuration->has(get_class($this), self::KEY_CONFIG_LOGTOERRORLOG)) {
            $this->setLogToErrorlog(
                $configuration->get(get_class($this),
                        self::KEY_CONFIG_LOGTOERRORLOG));
        }
        if ($configuration->has(get_class($this), self::KEY_CONFIG_LOGTOZENDLOG)) {
            $this->setLogToZendLog(
                $configuration->get(get_class($this),
                        self::KEY_CONFIG_LOGTOZENDLOG));
        }
        if ($configuration->has(get_class($this), self::KEY_CONFIG_ZENDLOGWRITER)) {
           $this->setZendLogWriter(
                $configuration->get(get_class($this),
                        self::KEY_CONFIG_ZENDLOGWRITER));
        }

        // Set default Zend_Log.
        $this->setZendLog(new Zend_Log());
    }

    /**
     * Loggs the Exception into the predefined destinations.
     *
     * @throws Exception if needed requirements not met.
     */
    public function log ()
    {
        if ($this->getLogToErrorlog()) {
            $this->logToErrorlog();
        }
        if ($this->getLogToZendLog()) {
            $this->logToZendLog();
        }
    }

    /**
     * Logs the exception to errorlog using php error_log.
     *
     * @throws Exception if exception could not be logged successfully.
     */
    protected function logToErrorlog ()
    {
        if (! error_log($this->getException()->__toString(), E_USER_ERROR)) {
            throw new Exception('Writing to errorlog failed.');
        }
    }

    /**
     * Logs the exception using Zend_Log (Zend Framework!) to
     * the given Zend_Log_Writer(s) Destination!
     *
     * @throws Exception
     */
    protected function logToZendLog ()
    {
        if (empty($this->zendLogWriter)) {
            throw new Exception(
                    'zendLogWriter object must be set in order to use Zend_Log!');
        }
        if (is_array($this->zendLogWriter)) {
            foreach ($this->getZendLogWriter() as $zendLogWriter) {
                $this->getZendLog()->addWriter($zendLogWriter);
            }
        } else {
            $this->getZendLog()->addWriter($this->getZendLogWriter());
        }
        // Log to registered writers!
        $this->getZendLog()->log($this->getException()
            ->__toString(), Zend_Log::ERR);
    }

    /**
     *
     * @return the $logToErrorlog
     */
    public function getLogToErrorlog ()
    {
        return $this->logToErrorlog;
    }

    /**
     *
     * @return the $logToZendLog
     */
    public function getLogToZendLog ()
    {
        return $this->logToZendLog;
    }

    /**
     *
     * @return the $zendLogWriter
     */
    public function getZendLogWriter ()
    {
        return $this->zendLogWriter;
    }

    /**
     *
     * @param $logToErrorlog boolean
     */
    public function setLogToErrorlog ($logToErrorlog)
    {
        $this->logToErrorlog = ! empty($logToErrorlog);
    }

    /**
     *
     * @param $logToZendLog boolean
     */
    public function setLogToZendLog ($logToZendLog)
    {
        $this->logToZendLog = ! empty($logToZendLog);
    }

    /**
     *
     * @param $zendLogWriter Zend_Log_Writer
     */
    public function setZendLogWriter ($zendLogWriter = null)
    {
        if(!is_array($zendLogWriter) && !$zendLogWriter instanceof Zend_Log_Writer){
            throw new Exception('Zend log writer must be an array or an instance of Zend_Log_Writer!');
        }
        $this->zendLogWriter = $zendLogWriter;
    }

    /**
     *
     * @return Zend_Log the $zendLog
     */
    public function getZendLog ()
    {
        return $this->zendLog;
    }

    /**
     *
     * @param $zendLogger Zend_Log
     */
    public function setZendLog (Zend_Log $zendLog = null)
    {
        $this->zendLog = $zendLog;
    }
}