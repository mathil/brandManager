<?php

namespace AppBundle\Controller;

use AppBundle\Entity\PushNotificationSchedule;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author mathil <github.com/mathil>
 * @Route("pushnotifications/schedule")
 */
class PushNotificationScheduleController extends Controller
{
    /**
     * Lists all pushNotificationSchedule entities.
     *
     * @Route("/", name="bm_pushnotificationschedule_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pushNotificationSchedules = $em->getRepository('AppBundle:PushNotificationSchedule')->findAll();

        return $this->render(
            'pushnotificationschedule/index.html.twig',
            array(
                'pushNotificationSchedules' => $pushNotificationSchedules,
            )
        );
    }

    /**
     * Creates a new pushNotificationSchedule entity.
     *
     * @Route("/new", name="bm_pushnotificationschedule_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $pushNotificationSchedule = new Pushnotificationschedule();
        $form = $this->createForm('AppBundle\Form\PushNotificationScheduleType', $pushNotificationSchedule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pushNotificationSchedule);
            $em->flush();

            return $this->redirectToRoute(
                'pushnotificationschedule_show',
                array('id' => $pushNotificationSchedule->getId())
            );
        }

        return $this->render(
            'pushnotificationschedule/new.html.twig',
            array(
                'pushNotificationSchedule' => $pushNotificationSchedule,
                'form' => $form->createView(),
            )
        );
    }

    /**
     * Finds and displays a pushNotificationSchedule entity.
     *
     * @Route("/{id}", name="bm_pushnotificationschedule_show")
     * @Method("GET")
     */
    public function showAction(PushNotificationSchedule $pushNotificationSchedule)
    {
        $deleteForm = $this->createDeleteForm($pushNotificationSchedule);

        return $this->render(
            'pushnotificationschedule/show.html.twig',
            array(
                'pushNotificationSchedule' => $pushNotificationSchedule,
                'delete_form' => $deleteForm->createView(),
            )
        );
    }

    /**
     * Displays a form to edit an existing pushNotificationSchedule entity.
     *
     * @Route("/{id}/edit", name="bm_pushnotificationschedule_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, PushNotificationSchedule $pushNotificationSchedule)
    {
        $deleteForm = $this->createDeleteForm($pushNotificationSchedule);
        $editForm = $this->createForm('AppBundle\Form\PushNotificationScheduleType', $pushNotificationSchedule);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute(
                'pushnotificationschedule_edit',
                array('id' => $pushNotificationSchedule->getId())
            );
        }

        return $this->render(
            'pushnotificationschedule/edit.html.twig',
            array(
                'pushNotificationSchedule' => $pushNotificationSchedule,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            )
        );
    }

    /**
     * Deletes a pushNotificationSchedule entity.
     *
     * @Route("/{id}", name="bm_pushnotificationschedule_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, PushNotificationSchedule $pushNotificationSchedule)
    {
        $form = $this->createDeleteForm($pushNotificationSchedule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pushNotificationSchedule);
            $em->flush();
        }

        return $this->redirectToRoute('pushnotificationschedule_index');
    }

    /**
     * Creates a form to delete a pushNotificationSchedule entity.
     *
     * @param PushNotificationSchedule $pushNotificationSchedule The pushNotificationSchedule entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PushNotificationSchedule $pushNotificationSchedule)
    {
        return $this->createFormBuilder()
            ->setAction(
                $this->generateUrl('pushnotificationschedule_delete', array('id' => $pushNotificationSchedule->getId()))
            )
            ->setMethod('DELETE')
            ->getForm();
    }
}
