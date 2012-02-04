<?php

/**
 * Default notification extension for PHPCeption.
 * Handles the notification to predefined recipients
 *  of an exception handled by PHPCeption.
 *
 * @author Julian Pustkuchen
 * @copyright Julian Pustkuchen - http://Julian.Pustkuchen.com
 * @license PHPCeption by Julian Pustkuchen is licensed under a Creative Commons Attribution-ShareAlike 3.0 Unported License. See LICENSE.txt
 */
class PHPCeption_Extensions_Notify extends PHPCeption_Extensions_AbstractExtension
{

    /**
     * Contains the notification methods
     * to use for notification.
     *
     * @var array<PHPCeption_Extensions_Notify_Method>
     */
    private $notifyMethods = array();

    // Configuration hash keys!
    const KEY_CONFIG_NOTIFY_METHODS = 'notify_methods';

    /**
     * Returns a new instance.
     *
     * @param $e Exception
     * @param $configuration PHPCeption_Configuration
     *
     * @return PHPCeption_Notify
     */
    public static function createInstance (Exception $e,
            PHPCeption_Configuration $configuration)
    {
        return new self($e, $configuration);
    }

    protected function __construct (Exception $exception,
            PHPCeption_Configuration $configuration)
    {
        parent::__construct($exception, $configuration);

        // Set configuration data if present.
        if ($configuration->has(get_class($this),
                self::KEY_CONFIG_NOTIFY_METHODS)) {
            $this->setNotifyMethods(
                    $configuration->get(get_class($this),
                            self::KEY_CONFIG_NOTIFY_METHODS));
        }
    }

    /**
     * Sends the notifications regarding to
     * the predefined configurations.
     */
    public function sendNotifications ()
    {
        $notifyMethods = $this->getNotifyMethods();
        if (! empty($notifyMethods)) {
            foreach ($notifyMethods as $notifyMethod) {
                /*
                 * @var $notifyMethod PHPCeption_Extensions_Notify_Method
                 */
                $notifyMethod->sendNotifications($this);
            }
        }
    }

    /**
     *
     * @return the $notifyMethods
     */
    public function getNotifyMethods ()
    {
        return $this->notifyMethods;
    }

    /**
     *
     * @param $notifyMethods array<PHPCeption_Extensions_Notify_Method>
     */
    public function setNotifyMethods (array $notifyMethods = array())
    {
        $this->notifyMethods = $notifyMethods;
    }
}