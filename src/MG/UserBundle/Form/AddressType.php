<?php

namespace MG\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Intl\Intl;

class AddressType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        \Locale::setDefault('fr');
        $countries = array_flip(Intl::getRegionBundle()->getCountryNames());
        $builder->add('street', TextType::class, array(
                'label' => 'form.street', 
                'translation_domain' => 'MGUserBundle'
        ))
        ->add('town', TextType::class, array(
                'label' => 'form.town', 
                'translation_domain' => 'MGUserBundle'
        ))
        ->add('zipCode', TextType::class, array(
                'label' => 'form.zipCode', 
                'translation_domain' => 'MGUserBundle'
        ))
        ->add('country',  CountryType::class, array(
                'choices' => $countries, // Array('France' => 'FR'),
                'label' => 'form.country',
                'translation_domain' => 'MGUserBundle'
        ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MG\UserBundle\Entity\Address'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'mg_userbundle_address';
    }


}
