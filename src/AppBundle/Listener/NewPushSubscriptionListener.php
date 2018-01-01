<?php

namespace AppBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use AppBundle\Entity\PushSubscription;


class NewPushSubscriptionListener {

    public function prePersist(LifecycleEventArgs $args) {
        $entity = $args->getEntity();

        if(!$entity instanceof PushSubscription) {
            return;
        }

        $this->writeToLog();

    }

    private function writeToLog() {
        $msg = "Dodano nową subskrypcję" . PHP_EOL;
        $filename = __DIR__ . "/../../../var/logs/subscriptions.log";
        file_put_contents($filename, $msg, FILE_APPEND);
    }



}
