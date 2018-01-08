<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User extends BaseUser {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=255)
     */
    private $surname;

    /**
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="users")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
    private $client;

    /**
     * @ORM\OneToMany(targetEntity="PushMessageHistory", mappedBy="sender")
     */
    private $sentPushMessages;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return User
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set surname
     *
     * @param string $surname
     *
     * @return User
     */
    public function setSurname($surname) {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string
     */
    public function getSurname() {
        return $this->surname;
    }

    /**
     * Set client
     *
     * @param \AppBundle\Entity\Client $client
     *
     * @return User
     */
    public function setClient(\AppBundle\Entity\Client $client = null) {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \AppBundle\Entity\Client
     */
    public function getClient() {
        return $this->client;
    }
    
    public function getFullName() {
        return $this->name . " " . $this->surname;
    }


    /**
     * Add sentPushMessage.
     *
     * @param \AppBundle\Entity\PushMessageHistory $sentPushMessage
     *
     * @return User
     */
    public function addSentPushMessage(\AppBundle\Entity\PushMessageHistory $sentPushMessage)
    {
        $this->sentPushMessages[] = $sentPushMessage;

        return $this;
    }

    /**
     * Remove sentPushMessage.
     *
     * @param \AppBundle\Entity\PushMessageHistory $sentPushMessage
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeSentPushMessage(\AppBundle\Entity\PushMessageHistory $sentPushMessage)
    {
        return $this->sentPushMessages->removeElement($sentPushMessage);
    }

    /**
     * Get sentPushMessages.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSentPushMessages()
    {
        return $this->sentPushMessages;
    }
}
