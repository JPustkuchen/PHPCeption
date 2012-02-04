<?php

/**
 * Contains the basic functionality for a flexible PHPCeption extension.
 * Shell be extended by concrete extension implementations.
 *
 * @author Julian Pustkuchen
 * @copyright Julian Pustkuchen - http://Julian.Pustkuchen.com
 * @license PHPCeption by Julian Pustkuchen is licensed under a Creative Commons Attribution-ShareAlike 3.0 Unported License. See LICENSE.txt
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
     * Returns the exception to handle.
     *
     * @return Exception the $exception
     */
    public function getException ()
    {
        return $this->exception;
    }

    /**
     * Returns the whole configuration used for the components.
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
    protected function setException (Exception $exception)
    {
        $this->exception = $exception;
    }

    /**
     *
     * @param $configuration PHPCeption_Configuration
     */
    protected function setConfiguration (PHPCeption_Configuration $configuration)
    {
        $this->configuration = $configuration;
    }
}