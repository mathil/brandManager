<?php

namespace AppBundle\Form;

use AppBundle\Form\Type\ScheduleType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
            'schedule',
            ScheduleType::class,
            [
                'label' => 'bm.global.schedule',

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
