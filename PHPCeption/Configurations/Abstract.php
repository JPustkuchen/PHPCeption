<?php

require_once ('PHPCeption/Configuration.php');

/**
 *
 * @author Julian Pustkuchen
 * @copyright Julian Pustkuchen - http://Julian.Pustkuchen.com
 * @license PHPCeption by Julian Pustkuchen is licensed under a Creative Commons
 *          Attribution-ShareAlike 3.0 Unported License. See LICENSE.txt
 */
abstract class PHPCeption_Configurations_Abstract implements
        PHPCeption_Configuration
{

    /**
     * The configuration values hash.
     *
     * @var array
     */
    private $values = array();

    /**
     * (non-PHPdoc)
     *
     * @see PHPCeption_Configuration::set()
     */
    public function set ($extensionClass, $key, $value)
    {
        if (empty($extensionClass)) {
            throw new Exception('Extension class may not be empty!');
        }
        if (empty($key)) {
            throw new Exception('Key may not be empty!');
        }
        $this->values[$extensionClass][$key] = $value;
    }

    /**
     * (non-PHPdoc)
     *
     * @see PHPCeption_Configuration::remove()
     */
    public function remove ($extensionClass, $key)
    {
        if (empty($extensionClass)) {
            throw new Exception('Extension class may not be empty!');
        }
        if (empty($key)) {
            throw new Exception('Key may not be empty!');
        }
        unset($this->values[$extensionClass][$key]);
    }

    /**
     * (non-PHPdoc)
     *
     * @see PHPCeption_Configuration::get()
     */
    public function get ($extensionClass, $key)
    {
        if (empty($extensionClass)) {
            throw new Exception('Extension class may not be empty!');
        }
        if (empty($key)) {
            throw new Exception('Key may not be empty!');
        }
        return $this->values[$extensionClass][$key];
    }

    /**
     * (non-PHPdoc)
     *
     * @see PHPCeption_Configuration::has()
     */
    public function has ($extensionClass, $key)
    {
        if (empty($extensionClass)) {
            throw new Exception('Extension class may not be empty!');
        }
        if (empty($key)) {
            throw new Exception('Key may not be empty!');
        }
        return isset($this->values[$extensionClass][$key]);
    }
}