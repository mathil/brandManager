<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DesktopController extends Controller
{

    /**
     * @Route("/", name="bm_desktop_index")
     */
    public function indexAction()
    {
        return $this->render('desktop/index.html.twig');
    }


}
