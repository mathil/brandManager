<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DesktopController extends Controller {

    /**
     * @Route("/", name="bm_desktop_index")
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $client = $em->getRepository('AppBundle:Client')->findClientByPushSubscriptionPublicKey('asd');


        return $this->render('desktop/index.html.twig');
    }


}
