<?php

require_once 'PHPUnit\Framework\TestSuite.php';
require_once 'Test\PHPCeption_PHPCeptionTest.php';

/**
 * Static test suite.
 */
class TestSuite extends PHPUnit_Framework_TestSuite
{

    /**
     * Constructs the test suite handler.
     */
    public function __construct ()
    {
        $this->setName('TestSuite');
        $this->addTestSuite('PHPCeption_PHPCeptionTest');
    }

    /**
     * Creates the suite.
     */
    public static function suite ()
    {
        return new self();
    }
}