<?php

/**
 *
 * @author Julian Pustkuchen
 */
class PHPCeption_Extensions_NotifyCreator extends PHPCeption_Handler
{

    /**
     * Returns a new instance
     *
     * @return PHPCeption_NotifyCreator
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
        $extensionNotify = PHPCeption_Extensions_Notify::
        createInstance($e, $configuration);
        $extensionNotify->sendNotifications();
    }
}