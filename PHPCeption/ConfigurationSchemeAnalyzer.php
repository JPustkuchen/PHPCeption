<?php

/**
* Analyzer for configuration schemes.
*
* Returns the specific configuration to use for the given exception type.
* Determines the selection by the exception class hierarchy.
*
* @author Julian Pustkuchen
* @copyright Julian Pustkuchen - http://Julian.Pustkuchen.com
* @license PHPCeption by Julian Pustkuchen is licensed under a Creative Commons Attribution-ShareAlike 3.0 Unported License. See LICENSE.txt
*/
class PHPCeption_ConfigurationSchemeAnalyzer
{

    /**
     * The configuration scheme to use for analysis.
     *
     * @var PHPCeption_Configurations_ConfigurationScheme
     */
    protected $configurationScheme;

    /**
     * Returns a new instance.
     *
     * @param PHPCeption_Configurations_ConfigurationScheme $configurationScheme
     * @return PHPCeption_ConfigurationSchemeAnalyzer
     */
    public static function createInstance (
            PHPCeption_Configurations_ConfigurationScheme $configurationScheme)
    {
        return new self($configurationScheme);
    }

    protected function __construct (
            PHPCeption_Configurations_ConfigurationScheme $configurationScheme)
    {
        $this->setConfigurationScheme($configurationScheme);
    }

    /**
     * Returns the determined configuration for the given
     * exception type.
     *
     * @param $e Exception
     * @return PHPCeption_Configuration
     */
    public function getConfiguration (Exception $e)
    {
        $exceptionClass = get_class($e);
        $schemeHash = $this->getConfigurationScheme()->getSchemeHash();
        if(!empty($schemeHash[$exceptionClass])){
            return $schemeHash[$exceptionClass];
        } else {
            // Look for parent class!
            $parentClass = get_parent_class($e);
            if($parentClass !== false){
                // Parent class exists!
                // Create dummy exception to use for further parent checks!
                $parentDummyException = new $parentClass();
                return $this->getConfiguration($parentDummyException);
            }
        }
        // Use fallback if no matching configuration could be found.
        return $this->getConfigurationScheme()->getFallbackConfiguration();
    }

    /**
     *
     * @return PHPCeption_Configurations_ConfigurationScheme the $scheme
     */
    public function getConfigurationScheme ()
    {
        return $this->configurationScheme;
    }

    /**
     *
     * @param $scheme PHPCeption_Configurations_ConfigurationScheme
     */
    protected function setConfigurationScheme (
            PHPCeption_Configurations_ConfigurationScheme $configurationScheme)
    {
        $this->configurationScheme = $configurationScheme;
    }

}