<?php

namespace CVThequeBundle\Form;

use CVThequeBundle\Entity\AdvertSkill;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdvertSkillType extends AbstractType
{  
  /**
   * {@inheritdoc}
   */
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('name', TextType::class, array(
                'label' => 'form.advertSkill.name', 
                'translation_domain' => 'CVThequeBundle'
        ));
  }
  
  /**
   * {@inheritdoc}
   */
  public function configureOptions(OptionsResolver $resolver)
  {
      $resolver->setDefaults(array(
              'data_class' => 'CVThequeBundle\Entity\AdvertSkill'
      ));
  }
  
  /**
   * {@inheritdoc}
   */
  public function getBlockPrefix()
  {
      return 'cvtheque_articlecompetence';
  }
  
}
