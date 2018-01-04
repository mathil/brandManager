<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Client
 *
 * @ORM\Table(name="client")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ClientRepository")
 */
class Client {

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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="client")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity="PushSubscription", mappedBy="client")
     */
    private $pushSubscriptions;

    /**
     * @ORM\OneToOne(targetEntity="PushSubscriptionSettings", inversedBy="client")
     * @ORM\JoinColumn(name="push_subscription_settings_id", referencedColumnName="id")
     */
    private $pushSubscriptionSettings;

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
     * @return Client
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
     * Constructor
     */
    public function __construct() {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Client
     */
    public function addUser(\AppBundle\Entity\User $user) {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \AppBundle\Entity\User $user
     */
    public function removeUser(\AppBundle\Entity\User $user) {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers() {
        return $this->users;
    }

    /**
     * Add pushSubscription
     *
     * @param \AppBundle\Entity\PushSubscription $pushSubscription
     *
     * @return Client
     */
    public function addPushSubscription(\AppBundle\Entity\PushSubscription $pushSubscription) {
        $this->pushSubscriptions[] = $pushSubscription;

        return $this;
    }

    /**
     * Remove pushSubscription
     *
     * @param \AppBundle\Entity\PushSubscription $pushSubscription
     */
    public function removePushSubscription(\AppBundle\Entity\PushSubscription $pushSubscription) {
        $this->pushSubscriptions->removeElement($pushSubscription);
    }

    /**
     * Get pushSubscriptions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPushSubscriptions() {
        return $this->pushSubscriptions;
    }

    /**
     * Set pushSubscriptionSettings
     *
     * @param \AppBundle\Entity\PushSubscriptionSettings $pushSubscriptionSettings
     *
     * @return Client
     */
    public function setPushSubscriptionSettings(\AppBundle\Entity\PushSubscriptionSettings $pushSubscriptionSettings = null) {
        $this->pushSubscriptionSettings = $pushSubscriptionSettings;

        return $this;
    }

    /**
     * Get pushSubscriptionSettings
     *
     * @return \AppBundle\Entity\PushSubscriptionSettings
     */
    public function getPushSubscriptionSettings() {
        return $this->pushSubscriptionSettings;
    }

    public function isPushSubscriptionSettingsConfigured() {
        return $this->pushSubscriptionSettings !== null
            && $this->pushSubscriptionSettings->getPrivateKey() !== null
            && $this->pushSubscriptionSettings->getPublicKey() !== null;
    }

}
