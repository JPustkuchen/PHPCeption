<?php

/**
 * Implements the notification by mail method.
 * Registered recipients receive an email if an exception is handled.
 *
 * @author Julian Pustkuchen
 * @copyright Julian Pustkuchen - http://Julian.Pustkuchen.com
 * @license PHPCeption by Julian Pustkuchen is licensed under a Creative Commons Attribution-ShareAlike 3.0 Unported License. See LICENSE.txt
 */
class PHPCeption_Extensions_Notify_Mail implements
        PHPCeption_Extensions_Notify_Method
{

    /**
     * The email sender email address.
     *
     * @var string
     */
    private $fromEmail;

    /**
     * The email sender alias.
     *
     * @var string
     */
    private $fromAlias;

    /**
     * The (official) email recipients array.
     * All these recipients are officially notified
     * about the exception and can see each other as recipients.
     * Important: At lease one official recipient must be set!!
     *
     * Hash key may be used as alias name. None used if empty!
     *
     * @var array
     */
    private $recipients = array();

    /**
     * The (hidden) email recipients array.
     * These recipients are inofficially notified
     * about the exception and are not shown
     * to other recipients.
     *
     * Hash key may be used as alias name. None used if empty!
     *
     * @var array
     */
    private $recipientsBcc = array();

    /**
     * The email subject prefix.
     *
     * @var string
     */
    private $subjectPrefix = 'Exception occured:';

    /**
     * The email subject suffix.
     *
     * @var string
     */
    private $subjectSuffix = '';

    /**
     * The mail teaser text.
     *
     * @var string
     */
    private $teaser = '';

    /**
     * The mail footer text.
     *
     * @var string
     */
    private $footer = '';

    /**
     * The area separator in mail body.
     *
     * @var string
     */
    private $areaSeperator = "\n=============================\n";

    /**
     * Defines if HTML mail is used.
     * Text Mail (strip_tags'ed)
     * is always used as fallback!
     *
     * @var bool
     */
    private $useHtml = false;

    /**
     * The Zend_Mail object for possible manipulations.
     *
     * @var Zend_Mail
     */
    private $zendMail;

    /**
     * Returns a new instance.
     * The Zend_Mail object may be preset for customization purposes.
     *
     * @param $zendMail Zend_Mail
     * @return PHPCeption_Extensions_Notify_Mail
     */
    public static function createInstance (Zend_Mail $zendMail = null)
    {
        return new self($zendMail);
    }

    protected function __construct (Zend_Mail $zendMail = null)
    {
        if ($zendMail === null) {
            $zendMail = new Zend_Mail();
        }
        $this->setZendMail($zendMail);
    }

    /**
     * Returns the exception mail subject text.
     *
     * @return string
     */
    protected function returnSubjectText (
            PHPCeption_Extensions_Notify $notification)
    {
        $subject = $this->getSubjectPrefix();
        $subject .= $notification->getException()->getMessage();
        $subject .= $this->getSubjectSuffix();
        return $subject;
    }

    /**
     * Returns the exception mail body text
     * containing the exception details.
     *
     * @return string
     */
    protected function returnBodyText (
            PHPCeption_Extensions_Notify $notification)
    {
        $body = $this->getTeaser();

        $body .= $this->getAreaSeperator();
        $body .= $this->returnExceptionDescription($notification);
        $body .= $this->getAreaSeperator();

        $body .= $this->getSubjectSuffix();

        return $body;
    }

    /**
     * Returns the exception description text.
     *
     * @param $notification PHPCeption_Extensions_Notify
     * @return string
     */
    protected function returnExceptionDescription (
            PHPCeption_Extensions_Notify $notification)
    {
        $e = $notification->getException();
        $desc = 'Message: ' . $e->getMessage();
        $desc .= "\n\n";
        $desc .= $e->getFile();
        $desc .= "\n";
        $desc .= $e->getLine();
        $desc .= "\n";
        $desc .= $e->getTraceAsString();

        return $desc;
    }

    /*
     * (non-PHPdoc) @see
     * PHPCeption_Extensions_Notify_Method::sendNotifications()
     */
    public function sendNotifications (
            PHPCeption_Extensions_Notify $notification)
    {
        $recipients = $this->getRecipients();
        $mail = new Zend_Mail();
        // Set from!
        $fromEmail = $this->getFromEmail();
        if (! empty($fromEmail)) {
            throw new Exception(
                    'A from email address must be set to send the notification by mail.');
        }
        $mail->setFrom($fromEmail, $this->getFromAlias());

        // Add recipients!
        if (empty($recipients)) {
            throw new Exception(
                    'At least one (official) recipient must be set to send email notifications.');
        }
        $mail->addTo($recipients);

        // Add BCC recipients!
        $recipientsBcc = $this->getRecipientsBcc();
        if (! empty($recipientsBcc)) {
            $mail->addBcc($recipientsBcc);
        }

        // Set subject
        $mail->setSubject($this->returnSubjectText($notification));

        // Set body!
        $mail->setBodyText(strip_tags($this->returnBodyText($notification)));
        if ($this->getUseHtml()) {
            $mail->setBodyHtml(
                    nl2br(htmlentities($this->returnBodyText($notification))));
        }

        $mail->send();
    }

    /**
     *
     * @return the $fromEmail
     */
    public function getFromEmail ()
    {
        return $this->fromEmail;
    }

    /**
     *
     * @return the $fromAlias
     */
    public function getFromAlias ()
    {
        return $this->fromAlias;
    }

    /**
     *
     * @return the $recipients
     */
    public function getRecipients ()
    {
        return $this->recipients;
    }

    /**
     *
     * @return the $subjectPrefix
     */
    public function getSubjectPrefix ()
    {
        return $this->subjectPrefix;
    }

    /**
     *
     * @return the $subjectSuffix
     */
    public function getSubjectSuffix ()
    {
        return $this->subjectSuffix;
    }

    /**
     *
     * @return the $teaser
     */
    public function getTeaser ()
    {
        return $this->teaser;
    }

    /**
     *
     * @return the $footer
     */
    public function getFooter ()
    {
        return $this->footer;
    }

    /**
     *
     * @param $fromEmail string
     */
    public function setFromEmail ($fromEmail)
    {
        $this->fromEmail = $fromEmail;
    }

    /**
     *
     * @param $fromAlias string
     */
    public function setFromAlias ($fromAlias)
    {
        $this->fromAlias = $fromAlias;
    }

    /**
     *
     * @param $recipients multitype:
     */
    public function setRecipients (array $recipients = array())
    {
        $this->recipients = $recipients;
    }

    /**
     *
     * @param $subjectPrefix string
     */
    public function setSubjectPrefix ($subjectPrefix)
    {
        $this->subjectPrefix = $subjectPrefix;
    }

    /**
     *
     * @param $subjectSuffix string
     */
    public function setSubjectSuffix ($subjectSuffix)
    {
        $this->subjectSuffix = $subjectSuffix;
    }

    /**
     *
     * @param $teaser string
     */
    public function setTeaser ($teaser)
    {
        $this->teaser = $teaser;
    }

    /**
     *
     * @param $footer string
     */
    public function setFooter ($footer)
    {
        $this->footer = $footer;
    }

    /**
     *
     * @return the $areaSeperator
     */
    public function getAreaSeperator ()
    {
        return $this->areaSeperator;
    }

    /**
     *
     * @param $areaSeperator string
     */
    public function setAreaSeperator ($areaSeperator)
    {
        $this->areaSeperator = $areaSeperator;
    }

    /**
     *
     * @return the $recipientsBcc
     */
    public function getRecipientsBcc ()
    {
        return $this->recipientsBcc;
    }

    /**
     *
     * @param $recipientsBcc multitype:
     */
    public function setRecipientsBcc (array $recipientsBcc = array())
    {
        $this->recipientsBcc = $recipientsBcc;
    }

    /**
     *
     * @return Zend_Mail the $zendMail
     */
    public function getZendMail ()
    {
        return $this->zendMail;
    }

    /**
     *
     * @param $zendMail Zend_Mail
     */
    public function setZendMail (Zend_Mail $zendMail = null)
    {
        $this->zendMail = $zendMail;
    }

    /**
     *
     * @return the $useHtml
     */
    public function getUseHtml ()
    {
        return $this->useHtml;
    }

    /**
     *
     * @param $useHtml boolean
     */
    public function setUseHtml ($useHtml)
    {
        $this->useHtml = ! empty($useHtml);
    }

}