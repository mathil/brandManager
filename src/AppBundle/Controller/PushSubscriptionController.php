<?php

namespace AppBundle\Controller;

use AppBundle\Entity\PushSubscription;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Pushsubscription controller.
 *
 * @Route("pushsubscription")
 */
class PushSubscriptionController extends Controller {

    /**
     * Lists all pushSubscription entities.
     *
     * @Route("/list", name="bm_pushsubscription_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $pushSubscriptions = $em->getRepository('AppBundle:PushSubscription')->findAll();

        return $this->render('pushsubscription/index.html.twig', array(
                    'pushSubscriptions' => $pushSubscriptions,
        ));
    }

    /**
     * Finds and displays a pushSubscription entity.
     *
     * @Route("/{id}/show", name="bm_pushsubscription_show")
     * @Method("GET")
     */
    public function showAction(PushSubscription $pushSubscription) {

        return $this->render('pushsubscription/show.html.twig', array(
                    'pushSubscription' => $pushSubscription,
        ));
    }

}
