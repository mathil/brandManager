<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author mathil <github.com/mathil>
 */
class ScheduleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('dateFrom', TextType::class, [
            'attr' => [
                'class' => 'datepicker'
            ]
        ]);
        $builder->add('dateTo', TextType::class, [
            'attr' => [
                'class' => 'datepicker'
            ]
        ]);
        $builder->add('daysOfMonth', CheckboxType::class, [

        ]);
        $builder->add('daysOfWeek', CheckboxType::class, [

        ]);
        $builder->add('hours', CheckboxType::class, [

        ]);
        $builder->add('minutes', CheckboxType::class, [

        ]);
        $builder->add('lastDayOfMonth', CheckboxType::class, [

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Schedule'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_client';
    }


}
