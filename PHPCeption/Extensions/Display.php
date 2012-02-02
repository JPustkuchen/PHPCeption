<?php

require_once 'PHPCeption/Extensions/AbstractExtension.php';

/**
 *
 * @author Julian Pustkuchen
 *
 *
 */
class PHPCeption_Extensions_Display extends PHPCeption_Extensions_AbstractExtension
{
    /**
     * The template name to use for display.
     *
     * @var string
     */
    protected $templateName = 'htmlDefault';

    const KEY_CONFIG_TEMPLATENAME = 'template_name';

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

    /**
     * Returns the Exception display code.
     */
    public function returnMessage ()
    {
        return '';
    }

    /**
     * Displays the Exception message nicely.
     */
    public function displayMessage ()
    {
        echo $this->returnMessage();
    }

    /**
     * Displays a whole HTML page containing only the displayMessage.
     */
    public function displayPage(){
        echo $this->returnPage();
    }

    /**
     * Returns a whole HTML page containing only the displayMessage.
     * @return string
     */
    public function returnPage(){
        return '';
    }
}