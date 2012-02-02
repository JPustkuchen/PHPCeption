<?php

/**
 *
 * @author Julian Pustkuchen
 *
 *
 */
class PHPCeption_Extensions_Log extends PHPCeption_Extensions_AbstractExtension
{

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

    public function log ()
    {
        //TODO!!!
    }

    /**
     * Logs the exception to errorlog using php error_log.
     */
    protected function logToErrorlog(){
        error_log($this->getException()->__toString(), E_USER_ERROR);
    }
}