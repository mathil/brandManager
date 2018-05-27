<?php

namespace AppBundle\Factory;

use AppBundle\DTO\PushMessageDTO;
use Doctrine\Common\Collections\Collection;


/**
 * @author mathil <github.com/mathil>
 */
class PushMessageDTOFactory
{

    /**
     * @param string $privateKey
     * @param string $publicKey
     * @param string $subject
     * @param string $message
     * @param null|string $imageUrl
     * @param bool $openUrl
     * @param null|string $url
     * @param Collection $subscriptions
     *
     * @return PushMessageDTO
     */
    public function createFromParameters(
        string $privateKey,
        string $publicKey,
        string $subject,
        string $message,
        ?string $imageUrl,
        bool $openUrl,
        ?string $url,
        Collection $subscriptions
    ): PushMessageDTO {
        return new PushMessageDTO(
            $privateKey, $publicKey, $subject, $message, $imageUrl, $openUrl, $url, $subscriptions
        );
    }

}