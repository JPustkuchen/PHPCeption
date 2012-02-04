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

    public static function createInstance (
            PHPCeption_Configurations_ConfigurationScheme $configurationScheme)
    {
        return new self($configurationScheme);
    }

    protected function __construct (
            PHPCeption_Configurations_ConfigurationScheme $configurationScheme)
    {
        $this->setScheme($configurationScheme);
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
        $configuration = $this->findClass(get_class($e));
        if(empty($configuration)){

        }

        return $configuration;
    }

    /**
     *
     * @param unknown_type $exceptionClass
     * @return PHPCeption_Configuration
     */
    protected function findClass($exceptionClass){
        return $configuration;
    }

    /**
     *
     * @return the $scheme
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