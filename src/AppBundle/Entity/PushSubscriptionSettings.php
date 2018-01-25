<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * PushSubscriptionSettings
 *
 * @ORM\Table(name="push_subscription_settings")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PushSubscriptionSettingsRepository")
 */
class PushSubscriptionSettings {

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
     * @ORM\Column(name="private_key", type="string", length=255)
     */
    private $privateKey;

    /**
     * @var string
     *
     * @ORM\Column(name="public_key", type="string", length=255)
     */
    private $publicKey;

    /**
     * @ORM\OneToMany(targetEntity="PushSubscriptionImage", mappedBy="client")
     */
    private $pushImages;

    /**
     * @ORM\OneToOne(targetEntity="Client", mappedBy="pushSubscriptionSettings")
     */
    private $client;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set privateKey
     *
     * @param string $privateKey
     *
     * @return PushSubscriptionSettings
     */
    public function setPrivateKey($privateKey) {
        $this->privateKey = $privateKey;

        return $this;
    }

    /**
     * Get privateKey
     *
     * @return string
     */
    public function getPrivateKey() {
        return $this->privateKey;
    }

    /**
     * Set publicKey
     *
     * @param string $publicKey
     *
     * @return PushSubscriptionSettings
     */
    public function setPublicKey($publicKey) {
        $this->publicKey = $publicKey;

        return $this;
    }

    /**
     * Get publicKey
     *
     * @return string
     */
    public function getPublicKey() {
        return $this->publicKey;
    }

    /**
     * Set pushImage
     *
     * @param string $pushImage
     *
     * @return PushSubscriptionSettings
     */
    public function setPushImage($pushImage) {
        $this->pushImage = $pushImage;

        return $this;
    }

    /**
     * Get pushImage
     *
     * @return string
     */
    public function getPushImage() {
        return $this->pushImage;
    }

    /**
     * Set client
     *
     * @param \AppBundle\Entity\Client $client
     *
     * @return PushSubscriptionSettings
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

}
