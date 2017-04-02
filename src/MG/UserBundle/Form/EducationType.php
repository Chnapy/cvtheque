<?php

namespace MG\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class EducationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('fromDate', DateType::class, array(
                'label' => 'form.fromDate', 
                'translation_domain' => 'MGUserBundle'
                ))
        ->add('toDate', DateType::class, array(
                'label' => 'form.toDate', 
                'translation_domain' => 'MGUserBundle'
                ))
        ->add('school', TextType::class, array(
                'label' => 'form.education.school', 
                'translation_domain' => 'MGUserBundle'
                ))
        ->add('degree', TextType::class, array(
                'label' => 'form.education.degree', 
                'translation_domain' => 'MGUserBundle'
                ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MG\UserBundle\Entity\Education'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'mg_userbundle_education';
    }


}
