<?php

namespace AppBundle\Service;

use AppBundle\DTO\PushMessageDTO;
use Doctrine\Common\Collections\Collection;
use Minishlink\WebPush\WebPush;

/**
 * @author mathil <github.com/mathil>
 */
class PushNotificationSender
{

    public function __construct()
    {
    }

    /**
     * @param PushMessageDTO $pushMessageDTO
     * @return array
     */
    public function send(PushMessageDTO $pushMessageDTO): array
    {
        $dataToSendAsJSON = json_encode($pushMessageDTO->getDataToSend());
        $webPush = new WebPush(
            [
                'VAPID' => [
                    'subject' => 'mailto:panhilson@gmail.com',
                    'publicKey' => $pushMessageDTO->getPublicKey(),
                    'privateKey' => $pushMessageDTO->getPrivateKey(),
                ],
            ]
        );

        $results = [
            'success' => 0,
            'fail' => 0,
        ];
        foreach ($pushMessageDTO->getSubscriptions() as $sub) {
            if (true === $webPush->sendNotification(
                    $sub->getEndpoint(),
                    $dataToSendAsJSON,
                    $sub->getP256dh(),
                    $sub->getAuth()
                )) {
                ++$results['success'];
            } else {
                ++$results['fail'];
            }
        }
        $webPush->flush();

        return $results;
    }
}
