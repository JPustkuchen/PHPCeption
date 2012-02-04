<?php

/**
* Represents a flexible handler for working with
* exceptions handled by PHPCeption via Observer Pattern.
*
* @author Julian Pustkuchen
* @copyright Julian Pustkuchen - http://Julian.Pustkuchen.com
* @license PHPCeption by Julian Pustkuchen is licensed under a Creative Commons Attribution-ShareAlike 3.0 Unported License. See LICENSE.txt
*/
abstract class PHPCeption_Handler
{
    /*
     * (non-PHPdoc) @see SplObserver::update()
     */
    public abstract function update (PHPCeption_PHPCeption $subject);
}