<?php

require_once 'PHPCeption/Configurations/Abstract.php';

/**
 *
 * @author Julian Pustkuchen
 * @copyright Julian Pustkuchen - http://Julian.Pustkuchen.com
 * @license PHPCeption by Julian Pustkuchen is licensed under a Creative Commons
 *          Attribution-ShareAlike 3.0 Unported License. See LICENSE.txt
 */
class PHPCeption_Configurations_Default extends PHPCeption_Configurations_Abstract
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
        require_once 'PHPCeption/Handlers/Display.php';
        require_once 'PHPCeption/Handlers/Log.php';
        require_once 'PHPCeption/Handlers/Notify.php';
        $this->set('PHPCeption_PHPCeption',
                PHPCeption_PHPCeption::CONFIG_KEY_AUTOREGISTER_HANDLERS,
                array(PHPCeption_Handlers_Display::createInstance(),
                        PHPCeption_Handlers_Log::createInstance(),
                        PHPCeption_Handlers_Notify::createInstance()));
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
        require_once 'Zend/Log/Writer/Firebug.php';
        $this->set('PHPCeption_Extensions_Log',
                PHPCeption_Extensions_Log::KEY_CONFIG_ZENDLOGWRITER,
                array(new Zend_Log_Writer_Firebug()));
    }

    protected function setDefaultsNotify ()
    {
        // -- Delete this line and replace the following values to use email
        // notifications!
        // Set email notification requirements (read API documentation for
        // details).
        require_once 'PHPCeption/Extensions/Notify/Mail.php';
        $notifyMethodMail = PHPCeption_Extensions_Notify_Mail::createInstance();
        $notifyMethodMail->setFromAlias('Example Exception');
        $notifyMethodMail->setFromEmail('no-reply@example.com');
        $notifyMethodMail->setRecipients(
                array('Mr./Mrs. Example' => 'info@example.com'));
        $notifyMethodMail->setRecipientsBCC(array());
        require_once 'PHPCeption/Extensions/Notify.php';
        $this->set('PHPCeption_Handlers_Notify',
                PHPCeption_Extensions_Notify::KEY_CONFIG_NOTIFY_METHODS,
                array($notifyMethodMail));
    }
}