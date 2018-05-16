<?php

namespace AppBundle\DTO;

use AppBundle\Enum\PushMessageActionEnum;
use Doctrine\Common\Collections\Collection;

/**
 * @author mathil <github.com/mathil>
 */
class PushMessageDTO
{

    /**
     * @var string
     */
    private $privateKey;

    /**
     * @var string
     */
    private $publicKey;

    /**
     * @var string
     */
    private $subject;

    /**
     * @var string
     */
    private $message;

    /**
     * @var string
     */
    private $imageUrl;

    /**
     * @var bool
     */
    private $openUrl;

    /**
     * @var string
     */
    private $url;

    /**
     * @var Collection
     */
    private $subscriptions;

    /**
     * PushMessageDTO constructor.
     * @param string $privateKey
     * @param string $publicKey
     * @param string $subject
     * @param string $message
     * @param null|string $imageUrl
     * @param bool $openUrl
     * @param null|string $url
     * @param Collection $subscriptions
     */
    public function __construct(
        string $privateKey,
        string $publicKey,
        string $subject,
        string $message,
        ?string $imageUrl,
        bool $openUrl,
        ?string $url,
        Collection $subscriptions
    ) {
        $this->privateKey = $privateKey;
        $this->publicKey = $publicKey;
        $this->subject = $subject;
        $this->message = $message;
        $this->imageUrl = $imageUrl;
        $this->openUrl = $openUrl;
        $this->url = $url;
        $this->subscriptions = $subscriptions;
    }

    /**
     * @return string
     */
    public function getPrivateKey(): string
    {
        return $this->privateKey;
    }

    /**
     * @param string $privateKey
     */
    public function setPrivateKey(string $privateKey)
    {
        $this->privateKey = $privateKey;
    }

    /**
     * @return string
     */
    public function getPublicKey(): string
    {
        return $this->publicKey;
    }

    /**
     * @param string $publicKey
     */
    public function setPublicKey(string $publicKey)
    {
        $this->publicKey = $publicKey;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     */
    public function setSubject(string $subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message)
    {
        $this->message = $message;
    }

    /**
     * @return null|string
     */
    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    /**
     * @param null|string $imageUrl
     */
    public function setImageUrl(?string $imageUrl)
    {
        $this->imageUrl = $imageUrl;
    }

    /**
     * @return bool
     */
    public function isOpenUrl(): bool
    {
        return $this->openUrl;
    }

    /**
     * @param bool $openUrl
     */
    public function setOpenUrl(bool $openUrl)
    {
        $this->openUrl = $openUrl;
    }

    /**
     * @return null|string
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param null|string $url
     */
    public function setUrl(?string $url)
    {
        $this->url = $url;
    }

    /**
     * @return Collection
     */
    public function getSubscriptions(): Collection
    {
        return $this->subscriptions;
    }

    /**
     * @param Collection $subscriptions
     */
    public function setSubscriptions(Collection $subscriptions)
    {
        $this->subscriptions = $subscriptions;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        if ($this->openUrl) {
            return PushMessageActionEnum::OPEN_URL;
        }

        return PushMessageActionEnum::CLOSE;
    }

    /**
     * @return array
     */
    public function getDataToSend(): array
    {
        return [
            'subject' => $this->subject,
            'message' => $this->message,
            'imageUrl' => $this->imageUrl,
            'openUrl' => $this->openUrl,
            'url' => $this->url,
        ];
    }
}
