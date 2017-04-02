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

class ApplicantRegistrationType extends AbstractType
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
        
        ->add('address', AddressType::class)
        ->add('titleProfile', TextType::class, array(
                'label' => 'form.titleProfile', 
                'translation_domain' => 'MGUserBundle'
        ))
        ->add('description', TextareaType::class, array(
                'label' => 'form.description', 
                'translation_domain' => 'MGUserBundle'
        ))
        ->add('phoneNumber', TextType::class, array(
                'label' => 'form.phoneNumber', 
                'translation_domain' => 'MGUserBundle'
        ))
        ->add('educations',  CollectionType::class, array(
                'entry_type' => EducationType::class,
                'allow_add'    => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => ''
        ))
        ->add('workExperiences',  CollectionType::class, array(
                'entry_type' => WorkExperienceType::class,
                'allow_add'    => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => '',
                'required' => false
        ))
        ->add('skills',  CollectionType::class, array(
                'entry_type' => SkillType::class,
                'allow_add'    => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => '',
                'required' => false
        ))
        ->add('hobbies',  CollectionType::class, array(
                'entry_type' => HobbyType::class,
                'allow_add'    => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => '',
                'required' => false
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
            'data_class' => 'MG\UserBundle\Entity\Applicant'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'mg_userbundle_registration_applicant';
    }
    
    public function getName()
    {
        return $this->getBlockPrefix();
    }
    
    
}
