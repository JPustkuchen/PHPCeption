<?php

/**
* Represents a PHPCeption Configuration.
* @author Julian Pustkuchen
* @copyright Julian Pustkuchen - http://Julian.Pustkuchen.com
* @license PHPCeption by Julian Pustkuchen is licensed under a Creative Commons Attribution-ShareAlike 3.0 Unported License. See LICENSE.txt
*/
interface PHPCeption_Configuration
{

    /**
     * Sets the given value for the $key within the scope
     * of $extensionClass.
     *
     * @param $extensionClass string           
     * @param $key string           
     * @param $value mixed           
     * @throws Exception if required parameter is empty.
     */
    public function set ($extensionClass, $key, $value);

    /**
     * Removes the value for the $key within the scope
     * of $extensionClass.
     * Nothing happens if no value exists for the given combination.
     *
     * @param $extensionClass string           
     * @param $key string           
     * @throws Exception if required parameter is empty.
     */
    public function remove ($extensionClass, $key);

    /**
     * Returns the value for the $key within the scope
     * of $extensionClass.
     * If no value set returns null.
     *
     * @param $extensionClass string           
     * @param $key string           
     *
     * @return mixed null
     * @throws Exception if required parameter is empty.
     */
    public function get ($extensionClass, $key);

    /**
     * Returns true if a value exists for $key within the scope
     * of $extensionClass.
     * Else returns false.
     *
     * @param $extensionClass string           
     * @param $key string           
     *
     * @return boolean
     * @throws Exception if required parameter is empty.
     */
    public function has ($extensionClass, $key);
}