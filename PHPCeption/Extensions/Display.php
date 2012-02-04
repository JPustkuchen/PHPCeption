<?php

require_once 'PHPCeption/Extensions/AbstractExtension.php';

/**
 * Default display extension for PHPCeption.
 * Handles the display of an exception handled by PHPCeption.
 *
 * @author Julian Pustkuchen
 * @copyright Julian Pustkuchen - http://Julian.Pustkuchen.com
 * @license PHPCeption by Julian Pustkuchen is licensed under a Creative Commons
 *          Attribution-ShareAlike 3.0 Unported License. See LICENSE.txt
 */
class PHPCeption_Extensions_Display extends PHPCeption_Extensions_AbstractExtension
{

    /**
     * The template name to use for display.
     *
     * @var string
     */
    protected $templateName = 'defaultHtml';

    /**
     * The template name to use for the HTML page body.
     *
     * @var string
     */
    protected $templateNameHtmlPagebody = 'defaultHtmlPagebody';

    /**
     * The template file suffix to append to template names.
     *
     * @var string
     */
    protected $templateFileSuffix = '.tpl.php';
    
    // Configuration hash keys!
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
        // Set variables
        $e = $this->getException();
        
        ob_start(); // Start output buffering.
                    // Instead of outputting anything, the output is now stored
                    // in a buffer.
        require $this->templateName;
        // There, now the file has been included and php parsed.
        // It isn't output, it goes into the buffer.
        $templateContent = ob_get_clean();
        // Now we read everything that has been buffered... And stops buffering.
        
        return $templateContent;
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
    public function displayPage ()
    {
        echo $this->returnPage();
    }

    /**
     * Returns a whole HTML page containing only the displayMessage.
     * 
     * @return string
     */
    public function returnPage ()
    {
        // Get Message body.
        $content = $this->returnMessage();
        
        // Set variables
        $e = $this->getException();
        
        ob_start(); // Start output buffering.
                    // Instead of outputting anything, the output is now stored
                    // in a buffer.
        require $this->templateNameHtmlPagebody . $this->templateFileSuffix;
        // There, now the file has been included and php parsed.
        // It isn't output, it goes into the buffer.
        $templateContent = ob_get_clean();
        // Now we read everything that has been buffered... And stops buffering.
        
        return $templateContent;
    }
}