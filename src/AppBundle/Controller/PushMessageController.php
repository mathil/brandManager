<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\PushMessageHistory;
use Symfony\Component\Form\FormInterface;
use AppBundle\Enum\PushMessageActionEnum;

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
            $this->prepareFormAndSendMessage($form);
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

    /**
     * @param FormInterface $form
     */
    private function prepareFormAndSendMessage(FormInterface $form)
    {
        $data = [
            'subject' => $form->get('subject')->getData(),
            'message' => $form->get('message')->getData(),
            'openUrl' => $form->get('openUrl')->getData(),
            'url' => $form->get('urlAddress')->getData()
        ];
        $privateKey = $this->getUser()->getClient()->getPushSubscriptionSettings()->getPrivateKey();
        $publicKey = $this->getUser()->getClient()->getPushSubscriptionSettings()->getPublicKey();
        $result = $this->get('AppBundle\Service\PushNotificationSender')->send($privateKey, $publicKey, $data, $this->getUser()->getClient()->getPushSubscriptions());
        $this->saveMessageToHistory($data, $result);
    }

    /**
     * @param array $data
     * @param array $result
     */
    private function saveMessageToHistory(array $data, array $result)
    {
        $history = (new PushMessageHistory())
            ->setMessage($data['message'])
            ->setSubject($data['subject'])
            ->setAction($data['openUrl'] ? PushMessageActionEnum::OPEN_URL : PushMessageActionEnum::CLOSE)
            ->setUrl($data['url'])
            ->setSentDate(new \DateTime())
            ->setSender($this->getUser())
            ->setReceivedFailCount($result['fail'])
            ->setReceivedSuccessCount($result['success']);
        $em = $this->getDoctrine()->getManager();
        $em->persist($history);
        $em->flush();
    }

}
