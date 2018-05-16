<?php
/**
 * Created by PhpStorm.
 * User: mateusz
 * Date: 10.05.18
 * Time: 22:15
 */

namespace AppBundle\Controller;

use AppBundle\Form\SearchBoxType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @author mathil <github.com/mathil>
 * @Route("pushnotifications/history")
 */
class PushMessageHistoryController extends Controller
{
    /**
     * @Route("/", name="bm_pushmessage_history")
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
        $params = $this->get('AppBundle\Factory\DatatablesParametersFactory')->createParams($request);
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
