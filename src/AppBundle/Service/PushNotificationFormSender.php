<?php
/**
 * Created by PhpStorm.
 * User: mateusz
 * Date: 28.01.18
 * Time: 23:29
 */

namespace AppBundle\Service;

use AppBundle\Entity\PushSubscriptionImage;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Routing\Router;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


/**
 * @author mathil <github.com/mathil>
 */
class PushNotificationFormSender
{

    /**
     * @var Router
     */
    private $router;

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var PushNotificationFormSender
     */
    private $sender;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * PushNotificationFormSender constructor.
     * @param Router $router
     * @param EntityManager $em
     * @param PushNotificationSender $sender
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(Router $router, EntityManager $em, PushNotificationSender $sender, TokenStorageInterface $tokenStorage)
    {
        $this->router = $router;
        $this->em = $em;
        $this->sender = $sender;
        $this->tokenStorage = $tokenStorage;

    }

    /**
     * @param FormInterface $form
     */
    public function prepareFormAndSend(FormInterface $form)
    {
        $image = $form->get('image')->getData();
        if ($image instanceof PushSubscriptionImage) {
            $imageUrl = $this->router->generate('bm_pushsubscription_show_image', ['path' => $image->getPath()], UrlGeneratorInterface::ABSOLUTE_URL);
        } else {
            $imageUrl = null;
        }
        $data = [
            'subject' => $form->get('subject')->getData(),
            'message' => $form->get('message')->getData(),
            'imageUrl' => $imageUrl,
            'openUrl' => $form->get('openUrl')->getData(),
            'url' => $form->get('urlAddress')->getData()
        ];
        $user  = $this->tokenStorage->getToken()->getUser();
        $privateKey = $user->getClient()->getPushSubscriptionSettings()->getPrivateKey();
        $publicKey = $user->getClient()->getPushSubscriptionSettings()->getPublicKey();
        $result = $this->sender->send($privateKey, $publicKey, $data, $user->getClient()->getPushSubscriptions());
        $this->em->getRepository('AppBundle:PushMessageHistory')->save($data, $result, $user);
    }

}