<?php

namespace AppBundle\Controller;

use AppBundle\Entity\PushSubscriptionImage;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\PushMessageHistory;
use Symfony\Component\Form\FormInterface;
use AppBundle\Enum\PushMessageActionEnum;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * @Route("pushmessage")
 */
class PushMessageController extends Controller
{

    /**
     * @Route("/send", name="bm_pushmessage_send")
     * @Method({"GET", "POST"})
     */
    public function sendAction(Request $request)
    {
        if (false === $this->getUser()->getClient()->isPushSubscriptionSettingsConfigured()) {
            return $this->render('pushmessage\config.html.twig');
        }

        $form = $this->createForm('AppBundle\Form\PushMessageType', []);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('AppBundle\Service\PushNotificationFormSender')->prepareFormAndSend($form);
        }

        return $this->render('pushmessage\new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/history", name="bm_pushmessage_history")
     * @Method({"GET"})
     */
    public function showHistoryAction()
    {
        return $this->render('pushmessage\history.html.twig', [
            'history' => $this->getDoctrine()->getManager()->getRepository('AppBundle:PushMessageHistory')->findAll()
        ]);
    }

    protected function formIsValid($form)
    {
        if (!$form->isValid()) {
            return false;
        }

        if ($form->get('openUrl')->getData()) {
            return filter_var($form->get('urlAddress'), FILTER_VALIDATE_URL);
        }
        return true;

    }

}
