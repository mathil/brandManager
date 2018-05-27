<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Schedule;
use AppBundle\Enum\DaysOfMonthEnum;
use AppBundle\Enum\DaysOfWeekEnum;
use AppBundle\Enum\HoursEnum;
use AppBundle\Enum\MinutesEnum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author mathil <github.com/mathil>
 */
class ScheduleType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'dateFrom',
            TextType::class,
            [
                'label' => 'bm.schedule.properties.date_from',
                'attr' => [
                    'class' => 'datepicker',
                ],
            ]
        );
        $builder->add(
            'dateTo',
            TextType::class,
            [
                'label' => 'bm.schedule.properties.date_to',
                'attr' => [
                    'class' => 'datepicker',
                ],
            ]
        );
        $builder->add(
            'allDaysOfMonth',
            CheckboxType::class,
            [
                'label' => 'bm.global.choose_all',
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'class' => 'choose-all-select2',
                    'data-choices-name' => 'daysOfMonth'
                ]
            ]
        );
        $builder->add(
            'daysOfMonth',
            ChoiceType::class,
            [
                'label' => 'bm.schedule.properties.days_of_month',
                'choices' => DaysOfMonthEnum::getDaysOfMonth(),
                'multiple' => true,
                'attr' => [
                    'class' => 'select2',
                    'data-choices' => 'daysOfMonth'
                ],
            ]
        );
        $builder->add(
            'allDaysOfWeek',
            CheckboxType::class,
            [
                'label' => 'bm.global.choose_all',
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'class' => 'choose-all-select2',
                    'data-choices-name' => 'daysOfWeek',
                ]
            ]
        );
        $builder->add(
            'daysOfWeek',
            ChoiceType::class,
            [
                'label' => 'bm.schedule.properties.days_of_week',
                'choices' => DaysOfWeekEnum::getDaysOfWeek(),
                'multiple' => true,
                'attr' => [
                    'class' => 'select2',
                    'data-choices' => 'daysOfWeek'
                ],
            ]
        );
        $builder->add(
            'allHours',
            CheckboxType::class,
            [
                'label' => 'bm.global.choose_all',
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'class' => 'choose-all-select2',
                    'data-choices-name' => 'hours'
                ]
            ]
        );
        $builder->add(
            'hours',
            ChoiceType::class,
            [
                'label' => 'bm.schedule.properties.hours',
                'choices' => HoursEnum::getHours(),
                'multiple' => true,
                'attr' => [
                    'class' => 'select2',
                    'data-choices' => 'hours'
                ],

            ]
        );
        $builder->add(
            'allMinutes',
            CheckboxType::class,
            [
                'label' => 'bm.global.choose_all',
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'class' => 'choose-all-select2',
                    'data-choices-name' => 'minutes'
                ]
            ]
        );
        $builder->add(
            'minutes',
            ChoiceType::class,
            [
                'label' => 'bm.schedule.properties.minutes',
                'choices' => MinutesEnum::getMinutes(),
                'multiple' => true,
                'attr' => [
                    'class' => 'select2',
                    'data-choices' => 'minutes'
                ],

            ]
        );
        $builder->add(
            'lastDayOfMonth',
            CheckboxType::class,
            [
                'label' => 'bm.schedule.properties.last_day_of_month',
                'required' => false,
            ]
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('class', Schedule::class);
        parent::configureOptions($resolver);
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        parent::buildView($view, $form, $options); // TODO: Change the autogenerated stub
    }
}
