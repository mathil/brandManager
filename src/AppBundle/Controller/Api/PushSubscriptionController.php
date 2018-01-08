<?php

namespace AppBundle\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\PushSubscription;

/**
 * Pushsubscription controller.
 *
 * @Route("api/pushsubscription")
 */
class PushSubscriptionController extends Controller {

    /**
     * Save pushSubscription.
     *
     * @Route("/save", name="bm_api_pushsubscription_save")
     * @Method({"POST"})
     */
    public function saveAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $subscription = json_decode($request->get('subscription'), true);
        $publicKey = $request->get('publicKey');

        $client = $em->getRepository('AppBundle:Client')->findClientByPushSubscriptionPublicKey($publicKey);
        if (!$client) {
            $response = new JsonResponse();
            $response->setData('bad');
            $response->headers->set('Access-Control-Allow-Origin', '*');
            return $response;
        }
        $pushSubscription = new PushSubscription($subscription['endpoint'], $subscription['keys']['p256dh'], $subscription['keys']['auth'], $client);
        $em->getRepository('AppBundle:PushSubscription')->persistSubscriptionIfNotExists($pushSubscription);
        $em->flush();
        $response = new JsonResponse();
        $response->setData('ok');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

}