<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PushMessageHistory
 *
 * @ORM\Table(name="push_message_history")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PushMessageHistoryRepository")
 */
class PushMessageHistory
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="subject", type="string", length=100)
     */
    private $subject;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="string", length=255)
     */
    private $message;

    /**
     * @var int
     *
     * @ORM\Column(name="received_success_count", type="integer")
     */
    private $receivedSuccessCount;

    /**
     * @var int
     *
     * @ORM\Column(name="received_fail_count", type="integer")
     */
    private $receivedFailCount;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sent_date", type="datetime")
     */
    private $sentDate;

    /**
     * @var string
     *
     * @ORM\Column(name="action", type="string", length=10)
     */
    private $action;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="sentPushMessages")
     * @ORM\JoinColumn(name="sender_id", referencedColumnName="id")
     */
    private $sender;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

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
     * Set receivedSuccessCount.
     *
     * @param int $receivedSuccessCount
     *
     * @return PushMessageHistory
     */
    public function setReceivedSuccessCount($receivedSuccessCount)
    {
        $this->receivedSuccessCount = $receivedSuccessCount;

        return $this;
    }

    /**
     * Get receivedSuccessCount.
     *
     * @return int
     */
    public function getReceivedSuccessCount()
    {
        return $this->receivedSuccessCount;
    }

    /**
     * Set receivedFailCount.
     *
     * @param int $receivedFailCount
     *
     * @return PushMessageHistory
     */
    public function setreceivedFailCount($receivedFailCount)
    {
        $this->receivedFailCount = $receivedFailCount;

        return $this;
    }

    /**
     * Get receivedFailCount.
     *
     * @return int
     */
    public function getreceivedFailCount()
    {
        return $this->receivedFailCount;
    }

    /**
     * Set sentDate.
     *
     * @param \DateTime $sentDate
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
     * @return \DateTime
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

    /**
     * Set sender.
     *
     * @param \AppBundle\Entity\User|null $sender
     *
     * @return PushMessageHistory
     */
    public function setSender(\AppBundle\Entity\User $sender = null)
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * Get sender.
     *
     * @return \AppBundle\Entity\User|null
     */
    public function getSender()
    {
        return $this->sender;
    }
}
