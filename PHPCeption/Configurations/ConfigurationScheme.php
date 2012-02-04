<?php

/**
* Represents a PHPCeption Configuration Scheme.
* The configuration scheme defines, which configuration is
* used in which Exception context.
*
* Definition of different configurations are made by
* assigning a configuration to one or several exception types.
* When an exception is handled by PHPCeption the configuration scheme
* is being looked up for general or
*
* @author Julian Pustkuchen
* @copyright Julian Pustkuchen - http://Julian.Pustkuchen.com
* @license PHPCeption by Julian Pustkuchen is licensed under a Creative Commons Attribution-ShareAlike 3.0 Unported License. See LICENSE.txt
*/
interface PHPCeption_Configurations_ConfigurationScheme
{
    /**
     * Returns the scheme definition hash.
     * The hash consists of keys with the Exception class names
     * and Configurations as key.
     * Result may be built programatically or as static array.
     *
     * @return array
     */
    public function getSchemeHash();

    /**
     * Returns the fallback configuration if no
     * fitting configuration is found within the scheme.
     *
     * @return PHPCeption_Configuration
     */
    public function getFallbackConfiguration();
}