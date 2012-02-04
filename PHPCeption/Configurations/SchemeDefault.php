<?php

require_once ('PHPCeption/Configurations/ConfigurationScheme.php');

/**
 * Represents the default configuration scheme.
 * Contains example definition for standard SPL exception types.
 *
 * @author Julian Pustkuchen
 * @copyright Julian Pustkuchen - http://Julian.Pustkuchen.com
 * @license PHPCeption by Julian Pustkuchen is licensed under a Creative Commons
 *          Attribution-ShareAlike 3.0 Unported License. See LICENSE.txt
 */
class PHPCeption_Configurations_SchemeDefault implements
        PHPCeption_Configurations_ConfigurationScheme
{

    /**
     * The static scheme definition.
     *
     * @var array
     */
    private $schemeHash;

    /**
     * The fallback configuration if no
     * determination by scheme works.
     *
     * @var PHPCeption_Configuration
     */
    protected $fallbackConfiguration;

    /**
     * Returns a new instance.
     *
     * @return PHPCeption_Configurations_SchemeDefault
     */
    public static function createInstance ()
    {
        return new self();
    }

    protected function __construct ()
    {
        $this->schemeHash = $this->createSchemeHash();
        $this->fallbackConfiguration = PHPCeption_Configurations_Default::createInstance();
    }

    /**
     * Helper function to create the scheme hash.
     *
     * @return array
     */
    protected function createSchemeHash ()
    {
        return array($this->getFallbackConfiguration() => Exception);
    }

    /*
     * (non-PHPdoc) @see
     * PHPCeption_Configurations_ConfigurationScheme::getSchemeHash()
     */
    public function getSchemeHash ()
    {
        return $this->schemeHash;
    }

    /*
     * (non-PHPdoc) @see
     * PHPCeption_Configurations_ConfigurationScheme::getFallbackConfiguration()
     */
    public function getFallbackConfiguration ()
    {
        return $this->fallbackConfiguration;
    }

}