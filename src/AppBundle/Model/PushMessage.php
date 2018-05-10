<?php

namespace AppBundle\Model;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @MappedSuperclass
 */
abstract class PushMessage extends BaseEntity
{

    /**
     * @var string
     *
     * @ORM\Column(name="subject", type="string", length=100)
     */
    protected $subject;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="string", length=255)
     */
    protected $message;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="sent_date", type="datetime")
     */
    protected $sentDate;

    /**
     * @var string
     *
     * @ORM\Column(name="action", type="string", length=10)
     */
    protected $action;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    protected $url;


    /**
     * Set subject.
     *
     * @param string $subject
     *
     * @return PushMessageHistory
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject.
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set message.
     *
     * @param string $message
     *
     * @return PushMessageHistory
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message.
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }


    /**
     * Set sentDate.
     *
     * @param DateTime $sentDate
     *
     * @return PushMessageHistory
     */
    public function setSentDate($sentDate)
    {
        $this->sentDate = $sentDate;

        return $this;
    }

    /**
     * Get sentDate.
     *
     * @return DateTime
     */
    public function getSentDate()
    {
        return $this->sentDate;
    }

    /**
     * Set action.
     *
     * @param string $action
     *
     * @return PushMessageHistory
     */
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get action.
     *
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set url.
     *
     * @param string $url
     *
     * @return PushMessageHistory
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }


}