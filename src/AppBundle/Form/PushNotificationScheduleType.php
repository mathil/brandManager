<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PushNotificationScheduleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name')
            ->add('hour')
            ->add('minute')
            ->add('dateFrom')
            ->add('dateTo')
            ->add('subject')
            ->add('message')
            ->add('sentDate')
            ->add('action')
            ->add('url')
            ->add('ctime')
            ->add('mtime');
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\PushNotificationSchedule'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_pushnotificationschedule';
    }


}
