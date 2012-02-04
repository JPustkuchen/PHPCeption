<?php

/**
 * Handler / Observer for the log extension of PHPCeption.
 * Creates a log extension instance if registered and notified
 * about a handled exception though and triggers the execution.
 *
 * @author Julian Pustkuchen
 * @copyright Julian Pustkuchen - http://Julian.Pustkuchen.com
 * @license PHPCeption by Julian Pustkuchen is licensed under a Creative Commons Attribution-ShareAlike 3.0 Unported License. See LICENSE.txt
 */
class PHPCeption_Handlers_Log extends PHPCeption_Handler
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

    public function update (PHPCeption_PHPCeption $subject)
    {
        $e = $subject->getCurrentException();
        $configuration = $subject->getConfiguration();
        $extensionLog = PHPCeption_Extensions_Log::createInstance($e,
                $configuration);
        $extensionLog->log();
    }
}