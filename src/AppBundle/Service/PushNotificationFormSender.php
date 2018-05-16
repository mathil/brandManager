<?php
/**
 * Created by PhpStorm.
 * User: mateusz
 * Date: 28.01.18
 * Time: 23:29
 */

namespace AppBundle\Service;

use AppBundle\DTO\PushMessageDTO;
use AppBundle\Entity\PushSubscriptionImage;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
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
    public function __construct(
        Router $router,
        EntityManager $em,
        PushNotificationSender $sender,
        TokenStorageInterface $tokenStorage
    ) {
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
            $imageUrl = $this->router->generate(
                'bm_pushsubscription_show_image',
                ['path' => $image->getPath()],
                UrlGeneratorInterface::ABSOLUTE_URL
            );
        } else {
            $imageUrl = null;
        }

        $user = $this->tokenStorage->getToken()->getUser();
        $pushMessageDTO = new PushMessageDTO(
            $user->getClient()->getPushSubscriptionSettings()->getPrivateKey(),
            $user->getClient()->getPushSubscriptionSettings()->getPublicKey(),
            $form->get('subject')->getData(),
            $form->get('message')->getData(),
            $imageUrl,
            $form->get('openUrl')->getData(),
            $form->get('urlAddress')->getData(),
            $user->getClient()->getPushSubscriptions()
        );

        $result = $this->sender->send($pushMessageDTO);
        $this->em->getRepository('AppBundle:PushMessageHistory')->save($pushMessageDTO, $result, $user);
    }

}
