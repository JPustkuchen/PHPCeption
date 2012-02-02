<?php

/**
*  Represents a flexible handler for working with
*  exceptions handled by PHPCeption via Observer Pattern.
*/
abstract class PHPCeption_Handler implements SplObserver
{
    /*
     * (non-PHPdoc) @see SplObserver::update()
     */
    public abstract function update (PHPCeption_PHPCeption $subject);
}