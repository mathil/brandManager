<?php

namespace AppBundle\Controller;

use AppBundle\Form\SearchBox;
use AppBundle\Form\SearchBoxType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author mathil <github.com/mathil>
 * @Route("pushnotifications")
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

        return $this->render(
            'pushmessage\new.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/history", name="bm_pushmessage_history")
     * @Method({"GET"})
     */
    public function showHistoryAction()
    {
        $searchBoxForm = $this->createForm(SearchBoxType::class);

        return $this->render(
            'pushmessage\history.html.twig',
            [
                'searchBoxForm' => $searchBoxForm->createView(),
            ]
        );
    }

    /**
     * @Route("/history/ajax", name="bm_pushmessage_history_ajax")
     * @Method({"GET"})
     */
    public function historyAjaxAction(Request $request)
    {
        $params = $this->createParams($request);
        $history = $this->get('AppBundle\Finder\PushMessageHistoryFinder')->getData($params);

        return new JsonResponse($history);
    }

    protected function isFormValid($form)
    {
        if (false === $form->isValid()) {
            return false;
        }

        if ($form->get('openUrl')->getData()) {
            return filter_var($form->get('urlAddress'), FILTER_VALIDATE_URL);
        }

        return true;

    }

}
