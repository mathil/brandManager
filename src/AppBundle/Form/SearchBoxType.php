<?php

namespace AppBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchBoxType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('dateFrom', TextType::class, [
            'required' => false,
            'label' => 'bm.global.date_from',
            'attr' => [
                'class' => 'datepicker'
            ]
        ]);
        $builder->add('dateTo', TextType::class, [
            'required' => false,
            'label' => 'bm.global.date_to',
            'attr' => [
                'class' => 'datepicker'
            ]
        ]);
        $builder->add('subject', TextType::class, [
            'required' => false,
            'label' => 'bm.push_message.properties.subject'

        ]);
        $builder->add('message', TextType::class, [
            'required' => false,
            'label' => 'bm.push_message.properties.message'
        ]);
        $builder->add('submit', SubmitType::class, [
            'label' => 'bm.global.search',
            'attr' => [
                'class' => 'search-box-submit',
            ]
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => null,
            'attr' => [
                'class' => 'search-box-form'
            ]
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'search_box_form';
    }


}
