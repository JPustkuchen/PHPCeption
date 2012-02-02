<?php

/**
 *
 * @author Julian Pustkuchen
 *
 *
 */
class PHPCeption_Extensions_Notify extends PHPCeption_Extensions_AbstractExtension
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

    public function sendNotifications(){

    }
}