<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * User controller.
 *
 * @Route("users")
 */
class UserController extends Controller
{
    /**
     * @Route("/list", name="bm_user_list")
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();

        return $this->render('user/index.html.twig', [
            'users' => $em->getRepository('AppBundle:User')->findAll()
        ]);
    }

}
