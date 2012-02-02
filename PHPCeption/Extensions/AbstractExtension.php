<?php

/**
 *
 * @author Julian Pustkuchen
 *
 *
 */

abstract class PHPCeption_Extensions_AbstractExtension
{

    /**
     * The exception being handled.
     *
     * @var Exception
     */
    private $exception;

    /**
     * The configuration object containing
     * configuration details for handling.
     *
     * @var PHPCeption_Configuration
     */
    private $configuration;

    protected function __construct (Exception $exception,
            PHPCeption_Configuration $configuration)
    {
        $this->setException($exception);
        $this->setConfiguration($configuration);
    }

    /**
     *
     * @return Exception the $exception
     */
    public function getException ()
    {
        return $this->exception;
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
     * @param $exception Exception
     */
    protected function setException ($exception)
    {
        $this->exception = $exception;
    }

    /**
     *
     * @param $configuration PHPCeption_Configuration
     */
    protected function setConfiguration ($configuration)
    {
        $this->configuration = $configuration;
    }
}