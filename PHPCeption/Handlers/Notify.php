<?php

/**
 * Handler / Observer for the notification extension of PHPCeption.
 * Creates a notification extension instance if registered and notified
 * about a handled exception though and triggers the execution.
 *
 * @author Julian Pustkuchen
 * @copyright Julian Pustkuchen - http://Julian.Pustkuchen.com
 * @license PHPCeption by Julian Pustkuchen is licensed under a Creative Commons Attribution-ShareAlike 3.0 Unported License. See LICENSE.txt
 */
class PHPCeption_Handlers_Notify extends PHPCeption_Handler
{

    /**
     * Returns a new instance
     *
     * @return PHPCeption_Handlers_Notify
     */
    public static function createInstance ()
    {
        return new self();
    }

    public function update (PHPCeption_PHPCeption $subject)
    {
        $e = $subject->getCurrentException();
        $configuration = $subject->getConfiguration();
        $extensionNotify = PHPCeption_Extensions_Notify::createInstance($e,
                $configuration);
        $extensionNotify->sendNotifications();
    }
}