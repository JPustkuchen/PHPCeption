<?php

/**
 *
 * @author Julian Pustkuchen
 *
 *
 */

class PHPCeption_Extensions_LogCreator extends PHPCeption_Handler
{

    /**
     * Returns a new Instance.
     *
     * @return PHPCeption_LogCreator
     */
    public static function createInstance ()
    {
        return new self();
    }

    protected function __construct ()
    {

    }

    public function update (SplSubject $subject)
    {
        $e = $subject->getCurrentException();
        $configuration = $subject->getConfiguration();
        $extensionLog = PHPCeption_Extensions_Log::
        createInstance($e, $configuration);
        $extensionLog->log();
    }
}