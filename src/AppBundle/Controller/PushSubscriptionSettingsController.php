<?php
/**
 * Created by PhpStorm.
 * User: mateusz
 * Date: 13.11.17
 * Time: 22:45
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class PushSubscriptionSettingsController
 * @package AppBundle\Controller
 * @Route("pushsubscription/settings")
 */
class PushSubscriptionSettingsController extends Controller
{

    /**
     * @Route("/", name="bm_pushsubscription_settings")
     * @Method("GET")
     */
    public function indexAction()
    {
        return $this->render('pushsubscription\settings\index.html.twig', [
            'privateApiKey' => $this->getUser()->getClient()->getPushSubscriptionSettings()->getPrivateKey(),
            'publicApiKey' => $this->getUser()->getClient()->getPushSubscriptionSettings()->getPublicKey()
        ]);
    }

    public function uploadImageAction()
    {

    }


}