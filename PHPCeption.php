<?php

/**
 * Flexible tool to handle exceptions.
 *
 * @author Julian Pustkuchen
 * @since 2012-02-01
 * @copyright Julian Pustkuchen - http://Julian.Pustkuchen.com
 * @license
 *
 */
class PHPCeption_PHPCeption implements SplSubject {
  /**
   * The configuration settings encapsulated in a flexible object.
   *
   * @var PHPCeption_Configuration
   */
  private $configuration;

  /**
   * Creates a new PHPCeption instance.
   *
   * @return PHPCeption_PHPCeption
   */
  public static function createInstance(PHPCeption_Configuration $parConfiguration = null) {
    return new self($parConfiguration);
  }

  protected function __construct(PHPCeption_Configuration $parConfiguration = null) {
    if($parConfiguration === null){
      $configuration = new PHPCeption_ConfigurationDefault();
    } else {
      $configuration = $parConfiguration;
    }
    $this->configuration = $configuration;
  }

  /**
   * Handles the given exception $e.
   * Uses the given $parSpecialConfiguration for configuration if given.
   * Else uses the PHPCeption object predefined $configuration.
   *
   * @param Exception $e The Exception to handle.
   * @param PHPCeption_Configuration $parSpecialConfiguration
   */
  public function handle(Exception $e, PHPCeption_Configuration $parSpecialConfiguration = null) {

  }

  /* (non-PHPdoc)
   * @see SplSubject::attach()
   */
  public function attach(SplObserver $observer) {
    // TODO Auto-generated method stub

  }

  /* (non-PHPdoc)
   * @see SplSubject::detach()
   */
  public function detach(SplObserver $observer) {
    // TODO Auto-generated method stub

  }

  /* (non-PHPdoc)
   * @see SplSubject::notify()
   */
  public function notify() {
    // TODO Auto-generated method stub

  }
}