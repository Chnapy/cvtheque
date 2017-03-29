<?php

namespace MG\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class AdminRegistrationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) 
    {    
        $builder
        ->add('firstname', TextType::class, array(
                'label' => 'form.firstname', 
                'translation_domain' => 'MGUserBundle'
        ))
        ->add('lastname', TextType::class, array(
                'label' => 'form.lastname', 
                'translation_domain' => 'MGUserBundle'
        ))
        ->add('address', AddressType::class)
        ->add('phoneNumber', TextType::class, array(
                'label' => 'form.phoneNumber', 
                'translation_domain' => 'MGUserBundle'
        ));
    }
    
    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MG\UserBundle\Entity\Admin'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'mg_userbundle_registration_admin';
    }
    
    public function getName()
    {
        return $this->getBlockPrefix();
    }
    
    
}