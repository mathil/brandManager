<?php

namespace AppBundle\Service;

use Doctrine\Common\Collections\Collection;
use Minishlink\WebPush\WebPush;


class PushNotificationSender
{

    public function __construct()
    {
    }

    public function send(string $privateKey, string $publicKey, array $dataToSend, Collection $pushSubscriptions): array
    {
        $dataToSendAsJSON = json_encode($dataToSend);
        $webPush = new WebPush([
            'VAPID' => [
                'subject' => 'mailto:panhilson@gmail.com',
                'publicKey' => $publicKey,
                'privateKey' => $privateKey,
            ]
        ]);

        $results = [
            'success' => 0,
            'fail' => 0
        ];
        foreach ($pushSubscriptions as $sub) {
            if (true === $webPush->sendNotification($sub->getEndpoint(), $dataToSendAsJSON, $sub->getP256dh(), $sub->getAuth())) {
                ++$results['success'];
            } else {
                ++$results['fail'];
            }
        }
        $webPush->flush();
        return $results;
    }




}