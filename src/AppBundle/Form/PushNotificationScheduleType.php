<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PushNotificationScheduleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'name',
            TextType::class,
            [
                'label' => 'bm.global.name',

            ]
        );
        $builder->add(
            'dateFrom',
            TextType::class,
            [
                'label' => 'bm.push_notification_schedule.properties.date_from',
                'attr' => [
                    'class' => 'datepicker',
                ],
            ]
        );
        $builder->add(
            'dateTo',
            TextType::class,
            [
                'label' => 'bm.push_notification_schedule.properties.date_to',
                'attr' => [
                    'class' => 'datepicker',
                ],

            ]
        );
        $builder->add(
            'subject',
            TextType::class,
            [
                'label' => 'bm.push_message.properties.subject',

            ]
        );
        $builder->add(
            'message',
            TextareaType::class,
            [
                'label' => 'bm.push_message.properties.message',

            ]
        );
        $builder->add(
            'action',
            TextType::class,
            [
                'label' => 'bm.push_message.properties.action',

            ]
        );
        $builder->add(
            'url',
            TextType::class,
            [
                'label' => 'bm.push_message.properties.url',

            ]
        );
        $builder->add(
            'hour',
            ChoiceType::class,
            [
                'label' => 'bm.global.hour',
                'choices' => range(0,23)

            ]
        );
        $builder->add(
            'minute',
            ChoiceType::class,
            [
                'label' => 'bm.global.minute',
                'choices' => [0, 15, 30, 45],

            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'AppBundle\Entity\PushNotificationSchedule',
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_pushnotificationschedule';
    }


}
