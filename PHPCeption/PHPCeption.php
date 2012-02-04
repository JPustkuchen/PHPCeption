<?php

/**
 * Flexible tool to handle exceptions.
 *
 * @author Julian Pustkuchen
 * @since 2012-02-01
 * @copyright Julian Pustkuchen - http://Julian.Pustkuchen.com
 * @license PHPCeption by Julian Pustkuchen is licensed under a Creative Commons Attribution-ShareAlike 3.0 Unported License. See LICENSE.txt
 */
class PHPCeption_PHPCeption implements SplSubject
{

    /**
     * The configuration settings encapsulated in a flexible object.
     *
     * @var PHPCeption_Configuration
     */
    private $configuration;

    /**
     * Keeps multiple handlers and possible other observers
     * that are notified if an exception is being handled.
     *
     * @var array
     */
    private $observers = array();

    /**
     * Keeps the current exception to handle.
     * Cleared after handle.
     *
     * @var Exception
     */
    private $currentException;

    // Configuration hash keys!
    const CONFIG_KEY_EXPERTMODE = 'expert_mode';

    const CONFIG_KEY_AUTOREGISTER_HANDLERS = 'autoregister_handlers';

    /**
     * Creates a new PHPCeption instance.
     *
     * @param $configuration PHPCeption_Configuration
     * @return PHPCeption_PHPCeption
     */
    public static function createInstance (
            PHPCeption_Configuration $configuration = null)
    {
        return new self($configuration);
    }

    /**
     *
     * @param $configuration PHPCeption_Configuration
     */
    protected function __construct (
            PHPCeption_Configuration $configuration = null)
    {
        if ($configuration === null) {
            require_once 'Configurations/Default.php';
            $configuration = PHPCeption_Configurations_Default::createInstance();
        }
        $this->configuration = $configuration;
    }

    /**
     * Handles the given exception $e.
     * Uses the given $parSpecialConfiguration for configuration if given.
     * Else uses the PHPCeption object predefined $configuration.
     *
     * @param $e Exception
     *            The Exception to handle.
     * @param $tmpSpecialConfiguration PHPCeption_Configuration
     */
    public function handle (Exception $e,
            PHPCeption_Configuration $tmpSpecialConfiguration = null)
    {
        // Set current exception for access by observers.
        $this->setCurrentException($e);

        // Keep main configuration
        $tmpMainConfiguration = $this->getConfiguration();
        if ($tmpSpecialConfiguration !== null) {
            // If temporary special configuration provided, set it temporarily.
            $this->setConfiguration($tmpSpecialConfiguration);
        }
        // Notify all observers / handlers.
        $this->notify();

        // Reset main configuration.
        $this->setConfiguration($tmpMainConfiguration);

        // Remove exception when finised.
        $this->setCurrentException(null);
    }

    /*
     * (non-PHPdoc) @see SplSubject::attach()
     */
    public function attach (SplObserver $observer)
    {
        $this->observers[] = $observer;
    }

    /*
     * (non-PHPdoc) @see SplSubject::detach()
     */
    public function detach (SplObserver $observer)
    {
        foreach ($this->observers as $key => $observer) {
            /*
             * @var $observers SplObserver
             */
            if ($observer === $observer) {
                unset($this->observers[$key]);
            }
        }
    }

    /*
     * (non-PHPdoc) @see SplSubject::notify()
     */
    public function notify ()
    {
        foreach ($this->observers as $key => $observer) {
            /*
             * @var $observer SplObserver
             */
            $observer->update($this);
        }
    }

    /**
     *
     * @return PHPCeption_Configuration the $configuration
     */
    public function getConfiguration ()
    {
        return $this->configuration;
    }

    /**
     *
     * @return array the $observers
     */
    public function getObservers ()
    {
        return $this->observers;
    }

    /**
     *
     * @param $configuration PHPCeption_Configuration
     */
    public function setConfiguration ($configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     *
     * @return Exception the $currentException
     */
    public function getCurrentException ()
    {
        return $this->currentException;
    }

    /**
     *
     * @param $currentException PHPCeption_PHPCeption
     */
    private function setCurrentException ($currentException)
    {
        $this->currentException = $currentException;
    }
}