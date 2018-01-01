<?php

namespace AppBundle\Service;

use Doctrine\Common\Collections\Collection;
use Minishlink\WebPush\WebPush;


class PushNotificationSender
{

    public function __construct()
    {
    }

    public function send(string $privateKey, string $publicKey, array $dataToSend, Collection $pushSubscriptions)
    {
        $dataToSend = json_encode($dataToSend);
        $webPush = new WebPush([
            'VAPID' => [
                'subject' => 'mailto:panhilson@gmail.com',
                'publicKey' => $publicKey,
                'privateKey' => $privateKey,
            ]
        ]);

        $results = array();
        foreach ($pushSubscriptions as $sub) {
            $results[] = $webPush->sendNotification($sub->getEndpoint(), $dataToSend, $sub->getP256dh(), $sub->getAuth());
        }
        $webPush->flush();
        return $results;
    }


}