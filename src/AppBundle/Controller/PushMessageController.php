<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Minishlink\WebPush\WebPush;

/**
 * Push message controller.
 *
 * @Route("pushmessage")
 */
class PushMessageController extends Controller {

    /**
     * @Route("/send", name="bm_pushmessage_send")
     * @Method({"GET", "POST"})
     */
    public function sendAction(Request $request) {
        if(!$this->getUser()->getClient()->isPushSubscriptionSettingsConfigured()) {
            return $this->render('pushmessage\config.html.twig');
        }


        $form = $this->createForm('AppBundle\Form\PushMessageType', []);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->prepareFormAndSendMessage($form);
        }

        return $this->render('pushmessage\new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    protected function formIsValid($form) {
        if(!$form->isValid()) {
            return false;
        }

        if($form->get('openUrl')->getData()) {
            return filter_var($form->get('urlAddress'), FILTER_VALIDATE_URL);
        }
        return true;

    }

    private function prepareFormAndSendMessage($form) {
        $data = [
            'subject' => $form->get('subject')->getData(),
            'message' => $form->get('message')->getData(),
            'openUrl' => $form->get('openUrl')->getData(),
            'url' => $form->get('urlAddress')->getData()
        ];
        $privateKey = $this->getUser()->getClient()->getPushSubscriptionSettings()->getPrivateKey();
        $publicKey = $this->getUser()->getClient()->getPushSubscriptionSettings()->getPublicKey();
        $this->get('AppBundle\Service\PushNotificationSender')->send($privateKey, $publicKey, $data, $this->getUser()->getClient()->getPushSubscriptions());

    }

}
