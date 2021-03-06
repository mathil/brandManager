<?php
/**
 * Created by PhpStorm.
 * User: mateusz
 * Date: 13.11.17
 * Time: 22:45
 */

namespace AppBundle\Controller;

use AppBundle\Entity\PushSubscriptionImage;
use AppBundle\Util\FileSaver;
use AppBundle\Util\RandomStringGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

/**
 * Class PushSubscriptionSettingsController
 * @package AppBundle\Controller
 * @Route("pushnotifications/settings")
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

    /**
     * @Route("/images", name="bm_pushsubscription_images")
     * @Method("GET")
     */
    public function imagesListAction()
    {
        $em = $this->getDoctrine()->getManager();
        $images = $em->getRepository('AppBundle:PushSubscriptionImage')->findBy(['client' => $this->getUser()->getClient()]);

        return $this->render('pushsubscription\settings\images.html.twig', [
            'images' => $images
        ]);

    }

    /**
     * @Route("/images/upload", name="bm_pushsubscription_upload_image")
     * @Method({"GET", "POST"})
     */
    public function newImageAction(Request $request)
    {
        if (false === $this->isImageUploadPossible()) {
            return $this->render('pushsubscription\settings\cannot_upload_image.html.twig');
        }

        $image = new PushSubscriptionImage();
        $form = $this->createForm('AppBundle\Form\PushSubscriptionImageType', $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $file = $image->getPath();

            $fileName = RandomStringGenerator::generateString(20) . '.' . $file->guessExtension();
            $file->move($this->getParameter('push_subscription_images_directory'), $fileName);

            $image->setPath($fileName);
            $image->setClient($this->getUser()->getClient());
            $em->persist($image);
            $em->flush();
            return $this->redirectToRoute('bm_pushsubscription_images');
        }

        return $this->render('pushsubscription\settings\upload_image.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/images/{path}/show", name="bm_pushsubscription_show_image")
     * @Method({"GET"})
     */
    public function showImageAction($path)
    {
        $imagesDirectory = $this->getParameter('push_subscription_images_directory');
        $filePath = $imagesDirectory . $path;
        return new BinaryFileResponse($filePath);
    }

    /**
     * @Route("/images/delete", name="bm_pushsubscription_delete_images")
     * @Method({"DELETE"})
     */
    public function deleteImagesAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $images = $em->getRepository('AppBundle:PushSubscriptionImage')->findByIds($request->get('ids'));
        $path = $this->getParameter('push_subscription_images_directory');
        foreach ($images as $image) {
            if (file_exists($path . $image->getPath())) {
                unlink($path . $image->getPath());
            }
            $em->remove($image);
        }
        $em->flush();

        return (new JsonResponse());
    }

    private function isImageUploadPossible()
    {
        $count = $this->getDoctrine()->getManager()->getRepository('AppBundle:PushSubscriptionImage')->getCount();
        return 5 > $count;
    }

    /**
     * @Route("/plugins", name="bm_pushsubscription_plugins")
     * @Method({"GET"})
     */
    public function pluginsAction()
    {
        return $this->render(':pushsubscription/settings:plugins.html.twig');
    }

    /**
     * @Route("/pushSubscriptionJsTemplate", name="bm_pushsubscription_generate_js_template")
     * @Method({"GET"})
     */
    public function generatePushSubscriptionTemplateAction()
    {
        $fileName = RandomStringGenerator::generateString(10, RandomStringGenerator::ONLY_ALPHANUMERIC) . '.js';
        return $this->generateJsBinaryResponse('push_subscription.js.twig', $fileName);
    }

    /**
     * @Route("/pushSubscriptionServiceWorker", name="bm_pushsubscription_generate_service_worker")
     * @Method({"GET"})
     */
    public function generateServiceWorkerTemplateAction()
    {
        return $this->generateJsBinaryResponse('service_worker.js.twig', 'sw.js');
    }

    private function generateJsBinaryResponse($templateName, $fileName)
    {
        $em = $this->getDoctrine()->getManager();
        $publicKey = $em->getRepository('AppBundle:PushSubscriptionSettings')->getPublicKeyForUser($this->getUser()->getId());
        $content = $this->renderView('external_js/' . $templateName, ['clientPublicKey' => $publicKey]);

        $destination = $this->getParameter('temp_files_dir');
        $path = FileSaver::createFileAndReturnPath($content, $fileName, $destination);

        $response = new BinaryFileResponse($path);
        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, $fileName);
        return $response;
    }

}
