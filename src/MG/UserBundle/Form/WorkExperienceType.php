<?php

namespace MG\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class WorkExperienceType extends AbstractType
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
        ->add('jobTitle', TextType::class, array(
                'label' => 'form.workExperience.jobTitle', 
                'translation_domain' => 'MGUserBundle'
                ))
        ->add('employer', TextType::class, array(
                'label' => 'form.workExperience.employer', 
                'translation_domain' => 'MGUserBundle'
                ))
        ->add('description', TextType::class, array(
                'label' => 'form.workExperience.description', 
                'translation_domain' => 'MGUserBundle'
                ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MG\UserBundle\Entity\WorkExperience'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'mg_userbundle_workexperience';
    }


}
