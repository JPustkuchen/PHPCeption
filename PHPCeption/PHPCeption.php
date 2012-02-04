<?php

/**
 * Flexible tool to handle exceptions.
 *
 * @author Julian Pustkuchen
 * @since 2012-02-01
 * @copyright Julian Pustkuchen - http://Julian.Pustkuchen.com
 * @license PHPCeption by Julian Pustkuchen is licensed under a Creative Commons Attribution-ShareAlike 3.0 Unported License. See LICENSE.txt
 */
class PHPCeption_PHPCeption
{

    /**
     * The configuration scheme
     * providing the configuration with
     * settings encapsulated in a flexible object.
     *
     * @var PHPCeption_Configurations_ConfigurationScheme
     */
    private $configurationScheme;

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

    /**
     * Keeps the current configuration to use for
     * handling the current exception.
     * Cleared after handle.
     *
     * @var Exception
     */
    private $currentConfiguration;

    /**
     * Determines if the expert mode should be used
     * for the current user.
     * This option allows for example to show further information,
     * etc. to the user calling.
     *
     * @var bool
     */
    private $expertMode = false;

    // Configuration hash keys!
    const CONFIG_KEY_EXPERTMODE = 'expert_mode';

    const CONFIG_KEY_AUTOREGISTER_HANDLERS = 'autoregister_handlers';

    /**
     * Creates a new PHPCeption instance.
     *
     * @param
     *            configurationSchemen PHPCeption_Configuration
     * @return PHPCeption_PHPCeption
     */
    public static function createInstance (
            PHPCeption_Configurations_ConfigurationScheme $configurationScheme = null)
    {
        return new self($configurationScheme);
    }

    /**
     *
     * @param $configurationScheme PHPCeption_Configurations_ConfigurationScheme
     */
    protected function __construct (
            PHPCeption_Configurations_ConfigurationScheme $configurationScheme = null)
    {
        // Set default configuration scheme
        if ($configurationScheme === null) {
            // None given, use default!
            require_once 'PHPCeption/Configurations/SchemeDefault.php';
            $configurationScheme = PHPCeption_Configurations_SchemeDefault::createInstance();
        }
        $this->setConfigurationScheme($configurationScheme);
    }

    /**
     * Handles the given exception $e.
     * Uses the given $parSpecialConfiguration for configuration if given.
     * Else uses the PHPCeption object predefined $configuration.
     *
     * @param $e Exception
     *            The Exception to handle.
     * @param $configurationOverride PHPCeption_Configuration
     */
    public function handle (Exception $e,
            PHPCeption_Configuration $configurationOverride = null)
    {
        $tmpExpertMode = $this->getExpertMode();
        $tmpObservers = $this->getObservers();

        // Set current exception for access by observers.
        $this->setCurrentException($e);

        // Set the current configuration for handling the exception.
        if ($configurationOverride === null) {
            require_once 'PHPCeption/ConfigurationSchemeAnalyzer.php';
            $configurationSchemeAnalyzer = PHPCeption_ConfigurationSchemeAnalyzer::createInstance(
                    $this->getConfigurationScheme());
            $this->setCurrentConfiguration(
                    $configurationSchemeAnalyzer->getConfiguration(
                            $this->getCurrentException()));
        }

        // Attach Configuration
        // Set expert mode.
        if($this->getConfiguration()->has(get_class($this), self::CONFIG_KEY_EXPERTMODE))
        {
          $this->setExpertMode($this->getConfiguration()->get(get_class($this), self::CONFIG_KEY_EXPERTMODE));
        }

        // Autoregister handlers by configuration.
        if($this->getConfiguration()->has(get_class($this), self::CONFIG_KEY_AUTOREGISTER_HANDLERS))
        {
          $autoregisterHandlers = $this->getConfiguration()->get(get_class($this), self::CONFIG_KEY_AUTOREGISTER_HANDLERS);
          if(!empty($autoregisterHandlers)){
            foreach ($autoregisterHandlers as $handler) {
              /* @var $handler PHPCeption_Handler */
              $this->attach($handler);
            }
          }
        }

        // Notify all observers / handlers.
        $this->notify();

        // Remove current exception/configuration when finised.
        $this->setCurrentException(null);
        $this->setCurrentConfiguration(null);
        $this->setExpertMode($tmpExpertMode);
        $this->setObservers($tmpObservers);
    }

    /**
     * Returns the configuration to use for
     * handling the current exception.
     *
     * @return PHPCeption_Configuration
     */
    public function getConfiguration ()
    {
        return $this->getCurrentConfiguration();
    }

    /*
     * (non-PHPdoc) @see SplSubject::attach()
     */
    public function attach (PHPCeption_Handler $observer)
    {
        $this->observers[] = $observer;
    }

    /*
     * (non-PHPdoc) @see SplSubject::detach()
     */
    public function detach (PHPCeption_Handler $observer)
    {
        foreach ($this->observers as $key => $observer) {
            /*
             * @var $observers PHPCeption_Handler
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
             * @var $observer PHPCeption_Handler
             */
            $observer->update($this);
        }
    }

    /**
     *
     * @return PHPCeption_Configurations_ConfigurationScheme the
     *         $configurationScheme
     */
    public function getConfigurationScheme ()
    {
        return $this->configurationScheme;
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
     * @param $configurationScheme PHPCeption_Configurations_ConfigurationScheme
     */
    public function setConfigurationScheme (
            PHPCeption_Configurations_ConfigurationScheme $configurationScheme)
    {
        $this->configurationScheme = $configurationScheme;
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
     * @param $currentException Exception
     */
    private function setCurrentException (Exception $currentException = null)
    {
        $this->currentException = $currentException;
    }

    /**
     *
     * @return PHPCeption_Configuration the $currentConfiguration
     */
    private function getCurrentConfiguration ()
    {
        return $this->currentConfiguration;
    }

    /**
     *
     * @param $currentConfiguration PHPCeption_Configuration
     */
    private function setCurrentConfiguration (
            PHPCeption_Configuration $currentConfiguration = null)
    {
        $this->currentConfiguration = $currentConfiguration;
    }

    /**
     *
     * @return boolean the $expertMode
     */
    public function getExpertMode ()
    {
        return $this->expertMode;
    }

    /**
     *
     * @param $expertMode boolean
     */
    public function setExpertMode ($expertMode)
    {
        $this->expertMode = ! empty($expertMode);
    }
	/**
 * @param multitype: $observers
 */
  private function setObservers($observers) {
    $this->observers = $observers;
  }


}