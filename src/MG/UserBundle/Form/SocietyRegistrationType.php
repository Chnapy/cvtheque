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
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
class SocietyRegistrationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) 
    {    
        $builder
        ->remove('username')
        ->add('username', TextType::class, array(
                'label' => 'form.society.name', 
                'translation_domain' => 'MGUserBundle'
        ))
        ->add('address', AddressType::class)
        ->add('phoneNumber', TextType::class, array(
                'label' => 'form.phoneNumber', 
                'translation_domain' => 'MGUserBundle'
        ))
        ->add('description', TextareaType::class, array(
                'label' => 'form.society.description', 
                'translation_domain' => 'MGUserBundle'
        ))
        ->add('image', PhotoType::class, array(
                'required'     => false
        ))
        ->add('category',  EntityType::class,        array(
                'label' => 'form.categories',
                'translation_domain' => 'CVThequeBundle',
                'class'    => 'CVThequeBundle:Category',
                'choice_label' => 'name',
                'multiple' => false,
                'required' => true
        ))
        ->add('effectif', TextType::class, array(
            'label' => 'form.effectif',
            'translation_domain' => 'MGUserBundle',
            'required' => true 
        ))
        ->add('activity', TextType::class, array(
            'label' => 'form.activity',
            'translation_domain' => 'MGUserBundle',
            'required' => true 
        ))
        ->add('tutor', TextType::class, array(
            'label' => 'form.tutor',
            'translation_domain' => 'MGUserBundle',
            'required' => true
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
            'data_class' => 'MG\UserBundle\Entity\Society'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'mg_userbundle_registration_society';
    }
    
    public function getName()
    {
        return $this->getBlockPrefix();
    }
    
    
}