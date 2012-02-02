<?php

require_once 'PHPCeption/ConfigurationAbstract.php';

/**
 * @author Julian Pustkuchen
 *
 *
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
        $this->set(PHPCeption_PHPCeption,
                PHPCeption_PHPCeption::CONFIG_KEY_EXPERTMODE, true);
    }

    protected function setDetaultsDisplay ()
    {
        require_once 'PHPCeption/Extensions/Display.php';
        $this->set(PHPCeption_Extensions_Display, PHPCeption_Extensions_Display::KEY_CONFIG_TEMPLATENAME, 'defaultHtml');
    }

    protected function setDefaultsLog ()
    {

    }

    protected function setDefaultsNotify ()
    {

    }
}