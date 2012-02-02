<?php

/**
 *
 * @author Julian Pustkuchen
 *
 *
 */
class PHPCeption_Extensions_DisplayCreator extends PHPCeption_Handler
{

    /**
     * Returns a new instance
     *
     * @return PHPCeption_DisplayCreator
     */
    public static function createInstance ()
    {
        return new self();
    }

    protected function __construct ()
    {

    }

    public function update (PHPCeption_PHPCeption $subject)
    {
        $e = $subject->getCurrentException();
        $configuration = $subject->getConfiguration();
        $extensionDisplay = PHPCeption_Extensions_Display::
            createInstance($e, $configuration);
        $extensionDisplay->displayPage();
    }
}