<?php

namespace AppBundle\Entity;

use AppBundle\Model\PushMessage;
use Doctrine\ORM\Mapping as ORM;

/**
 * PushMessageHistory
 *
 * @ORM\Table(name="push_message_history")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PushMessageHistoryRepository")
 */
class PushMessageHistory extends PushMessage
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
