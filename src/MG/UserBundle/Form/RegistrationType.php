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
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Intl\Intl;

class RegistrationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        \Locale::setDefault('fr');
        $countries = array_flip(Intl::getRegionBundle()->getCountryNames());
        $builder
        ->add('firstname', TextType::class, array(
                'label' => 'form.firstname', 
                'translation_domain' => 'MGUserBundle'
        ))
        ->add('lastname', TextType::class, array(
                'label' => 'form.lastname', 
                'translation_domain' => 'MGUserBundle'
        ))
        ->add('gender',  ChoiceType::class, array(
                'choices' => array(
                'form.m' => 'm',
                'form.f' => 'f'
                ),
                'required'    => true,
                'label' => 'form.gender',
                'translation_domain' => 'MGUserBundle'
        ))
        ->add('birthday', BirthdayType::class, array(
                'label' => 'form.birthdate', 
                'translation_domain' => 'MGUserBundle'
        ))
        ->add('country',  CountryType::class, array(
                'choices' => $countries,// Array('France' => 'FR'),
                'label' => 'form.country',
                'translation_domain' => 'MGUserBundle'
        ))
        ->add('town', TextType::class, array(
                'label' => 'form.town', 
                'translation_domain' => 'MGUserBundle'
        ))
        ->add('description', TextareaType::class, array(
                'label' => 'form.description', 
                'translation_domain' => 'MGUserBundle'
        ))
        ->add('hobbys',  CollectionType::class, array(
                'entry_type' => HobbyType::class,
                'allow_add'    => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => ''
        ))
        ->add('image', PhotoType::class, array(
                'required'     => false
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
            'data_class' => 'MG\UserBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'mg_userbundle_registration';
    }
    
    public function getName()
    {
        return $this->getBlockPrefix();
    }
    
    
}
