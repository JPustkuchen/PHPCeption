<?php

require_once 'PHPCeption/Configurations/Abstract.php';

/**
 * Configuration for simple logging of exceptions,
 * for example for usage directly in code within try/catch.
 *
 * @author Julian Pustkuchen
 * @copyright Julian Pustkuchen - http://Julian.Pustkuchen.com
 * @license PHPCeption by Julian Pustkuchen is licensed under a Creative Commons
 *          Attribution-ShareAlike 3.0 Unported License. See LICENSE.txt
 */
class PHPCeption_Configurations_LogOnly extends PHPCeption_Configurations_Default
{

    /**
     * Returns a new instance.
     *
     * @return PHPCeption_ConfigurationDefault
     */
    public static function createInstance ()
    {
        return new self();
    }

    protected function __construct ()
    {
        parent::__construct();
    }

    protected function setDefaultsMain ()
    {
        // Auto register the handlers on init.
        require_once 'PHPCeption/Handlers/Log.php';
        require_once 'PHPCeption/Handlers/Notify.php';
        $this->set('PHPCeption_PHPCeption',
                PHPCeption_PHPCeption::CONFIG_KEY_AUTOREGISTER_HANDLERS,
                array(PHPCeption_Handlers_Log::createInstance(),
                        PHPCeption_Handlers_Notify::createInstance()));
    }
}