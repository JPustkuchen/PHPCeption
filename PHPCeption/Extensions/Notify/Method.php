<?php

/**
 * Implements a notification method.
 * Registered recipients receive a notification if an exception is handled.
 *
 * @author Julian Pustkuchen
 * @copyright Julian Pustkuchen - http://Julian.Pustkuchen.com
 * @license PHPCeption by Julian Pustkuchen is licensed under a Creative Commons Attribution-ShareAlike 3.0 Unported License. See LICENSE.txt
 */
interface PHPCeption_Extensions_Notify_Method
{

    /**
     * Sends the notifications regarding to
     * the predefined configurations.
     *
     * @param PHPCeption_Extensions_Notify $notification The notification object triggering.
     */
    public function sendNotifications (
            PHPCeption_Extensions_Notify $notification);
}