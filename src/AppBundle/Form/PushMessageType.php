<?php

namespace AppBundle\Form;

use AppBundle\Form\Type\ImageEntityType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class PushMessageType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('subject', TextType::class, [
                'label' => 'bm.push_message.properties.subject',
                'attr' => [
                    'style' => 'width: 500px;',
                    'maxlength' => 100
                ]
            ])
            ->add('message', TextareaType::class, [
                'label' => 'bm.push_message.properties.message',
                'attr' => [
                    'style' => 'resize: none; width: 500px; height: 200px;',
                    'maxlength' => 255
                ]
            ])
            ->add('image', ImageEntityType::class, [
                'label' => 'bm.push_message.properties.image',
                'choice_label' => 'name',
                'class' => 'AppBundle\Entity\PushSubscriptionImage',
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('i')
                        ->orderBy('i.name', 'ASC');
                }
            ])
            ->add('openUrl', CheckboxType::class, [
                'label' => 'bm.push_message.properties.open_url_after_click',
                'data' => true,
                'required' => false
            ])
            ->add('urlAddress', UrlType::class, [
                'label' => 'bm.push_message.properties.url',
                'label_attr' => ['class' => 'bm_push_message_url_address'],
                'attr' => ['class' => 'bm_push_message_url_address'],
                'required' => false
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'bm.global.send'
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => null
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'bm_push_message_form';
    }

}
