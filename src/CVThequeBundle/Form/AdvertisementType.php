<?php

namespace CVThequeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use MG\UserBundle\Form\SkillType;

class AdvertisementType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('author', TextType::class, array(
                'label' => 'form.author', 
                'translation_domain' => 'CVThequeBundle'
        ))
        ->add('title', TextType::class, array(
                'label' => 'form.title', 
                'translation_domain' => 'CVThequeBundle'
        ))
        ->add('content', TextareaType::class, array(
                'label' => 'form.content', 
                'translation_domain' => 'CVThequeBundle'
        ))
        ->add('category',  EntityType::class,        array(
                'label' => 'form.categories',
                'translation_domain' => 'CVThequeBundle',
                'class'    => 'CVThequeBundle:Category',
                'choice_label' => 'name',
                'multiple' => false
        ))
        ->add('advertSkills', CollectionType::class, array(
                'entry_type' => SkillType::class,
                'allow_add'    => true,
                'allow_delete' => true,
                'by_reference' => false,
        ))
        ->add('image', ImageType::class, array(
                'required'     => false
        ))
        ->add('published', CheckboxType::class, array(
                'label' => 'form.published',
                'translation_domain' => 'CVThequeBundle',
                'required' => false
        ))
        ->add('save',      SubmitType::class, array(
                'label' => 'form.submit', 
                'translation_domain' => 'CVThequeBundle'
        ));
        
        // Fonction qui écoute l'événement PRE_SET_DATA
        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function(FormEvent $event) {
              $advertisement = $event->getData();
        
              if (null === $advertisement) {
                return;
              }
        
              if (false === $advertisement->isPublished()){
                $event->getForm()->add('published', CheckboxType::class, null, array('required' => false));
              } 
        
              if (null === $advertisement->getSociety()) {
                $event->getForm()->add('authorr', TextType::class, array(
                        'label' => 'form.society',
                        'translation_domain' => 'CVThequeBundle'
                ));
              }
            }
        );
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CVThequeBundle\Entity\Advertisement'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cvtheque_advertisement';
    }
}