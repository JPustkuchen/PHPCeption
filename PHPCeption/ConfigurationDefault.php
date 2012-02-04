<?php

require_once 'PHPCeption/ConfigurationAbstract.php';

/**
 *
 * @author Julian Pustkuchen
 * @copyright Julian Pustkuchen - http://Julian.Pustkuchen.com
 * @license PHPCeption by Julian Pustkuchen is licensed under a Creative Commons
 *          Attribution-ShareAlike 3.0 Unported License. See LICENSE.txt
 */
class PHPCeption_ConfigurationDefault extends PHPCeption_ConfigurationAbstract
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
        $this->setAllDefaults();
    }

    /**
     * Sets all defaults.
     */
    protected function setAllDefaults ()
    {
        $this->setDefaultsMain();
        $this->setDetaultsDisplay();
        $this->setDefaultsLog();
        $this->setDefaultsNotify();
    }

    protected function setDefaultsMain ()
    {
        // Enable expert mode with further information about Exceptions.
        $this->set('PHPCeption_PHPCeption', 
                PHPCeption_PHPCeption::CONFIG_KEY_EXPERTMODE, true);
        
        // Auto register the handlers on init.
        require_once 'PHPCeption/Handlers/DisplayHandler.php';
        require_once 'PHPCeption/Handlers/LogHandler.php';
        require_once 'PHPCeption/Handlers/NotifyHandler.php';
        $this->set('PHPCeption_PHPCeption', 
                PHPCeption_PHPCeption::CONFIG_KEY_AUTOREGISTER_HANDLERS, 
                array(PHPCeption_Extensions_DisplayHandler::createInstance(), 
                        PHPCeption_Extensions_LogHandler::createInstance(), 
                        PHPCeption_Extensions_NotifyHandler::createInstance()));
    }

    protected function setDetaultsDisplay ()
    {
        require_once 'PHPCeption/Extensions/Display.php';
        $this->set('PHPCeption_Extensions_Display', 
                PHPCeption_Extensions_Display::KEY_CONFIG_TEMPLATENAME, 
                'defaultHtml');
    }

    protected function setDefaultsLog ()
    {
        require_once 'PHPCeption/Extensions/Log.php';
        $this->set('PHPCeption_Extensions_Log', 
                PHPCeption_Extensions_Log::KEY_CONFIG_LOGTOERRORLOG, true);
        $this->set('PHPCeption_Extensions_Log', 
                PHPCeption_Extensions_Log::KEY_CONFIG_LOGTOZENDLOG, false);
        $this->set('PHPCeption_Extensions_Log', 
                PHPCeption_Extensions_Log::KEY_CONFIG_ZENDLOGWRITER, 
                array(new Zend_Log_Writer_Firebug()));
    }

    protected function setDefaultsNotify ()
    {

    }
}