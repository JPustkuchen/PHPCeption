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
     * The templates folder path (without trailing slash!)
     *
     * @var string
     */
    protected $templatesPath = 'PHPCeption/Extensions/Display/templates';

    /**
     * The template name to use for display.
     * (Without suffix!)
     *
     * @var string
     */
    protected $templateName = 'defaultHtml';

    /**
     * The template name to use for the HTML page body.
     * (Without suffix!)
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

    const KEY_CONFIG_TEMPLATENAME_HTML_PAGEBODY = 'template_name_html_pagebody';

    const KEY_CONFIG_TEMPLATEFILESUFFIX = 'template_file_suffix';

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
        // Set configuration data if given.
        if ($configuration->has(get_class($this), self::KEY_CONFIG_TEMPLATENAME)) {
            $this->setTemplateName(
                    $configuration->get(get_class($this),
                            self::KEY_CONFIG_TEMPLATENAME));
        }

        if ($configuration->has(get_class($this),
                self::KEY_CONFIG_TEMPLATENAME_HTML_PAGEBODY)) {
            $this->setTemplateNameHtmlPagebody(
                    $configuration->get(get_class($this),
                            self::KEY_CONFIG_TEMPLATENAME_HTML_PAGEBODY));
        }

        if ($configuration->has(get_class($this),
                self::KEY_CONFIG_TEMPLATEFILESUFFIX)) {
            $this->setTemplateFileSuffix(
                    $configuration->get(get_class($this),
                            self::KEY_CONFIG_TEMPLATEFILESUFFIX));
        }
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
        require $this->getTemplatesPath() . '/' . $this->getTemplateName() . $this->getTemplateFileSuffix();
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
        require $this->getTemplatesPath() . '/' . $this->getTemplateNameHtmlPagebody() . $this->getTemplateFileSuffix();
        // There, now the file has been included and php parsed.
        // It isn't output, it goes into the buffer.
        $templateContent = ob_get_clean();
        // Now we read everything that has been buffered... And stops buffering.

        return $templateContent;
    }

    /**
     *
     * @return the $templateName
     */
    public function getTemplateName ()
    {
        return $this->templateName;
    }

    /**
     *
     * @return the $templateNameHtmlPagebody
     */
    public function getTemplateNameHtmlPagebody ()
    {
        return $this->templateNameHtmlPagebody;
    }

    /**
     *
     * @return the $templateFileSuffix
     */
    public function getTemplateFileSuffix ()
    {
        return $this->templateFileSuffix;
    }

    /**
     *
     * @param $templateName string
     */
    public function setTemplateName ($templateName)
    {
        $this->templateName = $templateName;
    }

    /**
     *
     * @param $templateNameHtmlPagebody string
     */
    public function setTemplateNameHtmlPagebody ($templateNameHtmlPagebody)
    {
        $this->templateNameHtmlPagebody = $templateNameHtmlPagebody;
    }

    /**
     *
     * @param $templateFileSuffix string
     */
    public function setTemplateFileSuffix ($templateFileSuffix)
    {
        $this->templateFileSuffix = $templateFileSuffix;
    }
	/**
 * @return the $templatesPath
 */
  public function getTemplatesPath() {
    return $this->templatesPath;
  }

	/**
 * @param string $templatesPath
 */
  public function setTemplatesPath($templatesPath) {
    $this->templatesPath = $templatesPath;
  }


}