<?php

namespace AppBundle\Entity;

use AppBundle\Model\BaseEntity;
use Doctrine\ORM\Mapping as ORM;



/**
 * PushSubscription
 * @ORM\Table(name="push_subscription")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PushSubscriptionRepository")
 */
class PushSubscription extends BaseEntity {

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
     * @ORM\Column(name="endpoint", type="string", length=255)
     */
    private $endpoint;

    /**
     * @var string
     *
     * @ORM\Column(name="p256dh", type="string", length=255)
     */
    private $p256dh;

    /**
     * @var string
     *
     * @ORM\Column(name="auth", type="string", length=255)
     */
    private $auth;

    /**
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="pushSubscriptions")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
    private $client;

    public function __construct($endpoint, $p256dh, $auth, $client) {
        $this->endpoint = $endpoint;
        $this->p256dh = $p256dh;
        $this->auth = $auth;
        $this->client = $client;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set endpoint
     *
     * @param string $endpoint
     *
     * @return PushSubscription
     */
    public function setEndpoint($endpoint) {
        $this->endpoint = $endpoint;

        return $this;
    }

    /**
     * Get endpoint
     *
     * @return string
     */
    public function getEndpoint() {
        return $this->endpoint;
    }

    /**
     * Set p256dh
     *
     * @param string $p256dh
     *
     * @return PushSubscription
     */
    public function setP256dh($p256dh) {
        $this->p256dh = $p256dh;

        return $this;
    }

    /**
     * Get p256dh
     *
     * @return string
     */
    public function getP256dh() {
        return $this->p256dh;
    }

    /**
     * Set auth
     *
     * @param string $auth
     *
     * @return PushSubscription
     */
    public function setAuth($auth) {
        $this->auth = $auth;

        return $this;
    }

    /**
     * Get auth
     *
     * @return string
     */
    public function getAuth() {
        return $this->auth;
    }

    /**
     * Set client
     *
     * @param \AppBundle\Entity\Client $client
     *
     * @return PushSubscription
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
