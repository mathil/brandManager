<?php

namespace AppBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use AppBundle\Entity\PushSubscription;


class NewPushSubscriptionListener {

    public function postPersist(LifecycleEventArgs $args) {
        $entity = $args->getEntity();

        if(!$entity instanceof PushSubscription) {
            return;
        }

        $this->writeToLog();

    }

    private function writeToLog() {
        $msg = "[" . (new \DateTime())->format('d.m.Y H:i:s') . "] Dodano nową subskrypcję";

        $filename = __DIR__ . "/../../../var/logs/subscriptions.log";
        file_put_contents($filename, $msg, FILE_APPEND);
    }



}
