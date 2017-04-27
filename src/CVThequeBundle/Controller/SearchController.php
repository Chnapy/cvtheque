<?php

namespace CVThequeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends Controller
{
    public function advertAction(Request $request)
    {
        $advertisements = null;
        $formAdvert = $this->createFormSearch();
        $formAdvert->handleRequest($request);
        if ($formAdvert->isSubmitted() && $formAdvert->isValid())
        {
            $textSearch = $formAdvert['search']->getData();
            $advertisements = $this->get('fos_elastica.index.cvtheque.Advertisement')
            ->search($textSearch);
        }
        return $this->render('CVThequeBundle:Search:advert.html.twig', array(
            'form' => $formAdvert->createView(),
            'advertisements' => $advertisements
        ));
    }

    public function applicantAction(Request $request)
    {
        $applicants = null;
        $formApplicant = $this->createForm();
        $formApplicant->handleRequest($request);
        if ($formApplicant->isSubmitted() && $formApplicant->isValid())
        {
            $textSearch = $formApplicant['search']->getData();
            $applicants = $this->get('fos_elastica.index.cvtheque.Applicant')
            ->search($textSearch);
        }
        return $this->render('CVThequeBundle:Search:applicant.html.twig', array(
            'form' => $formApplicant->createView(),
            'applicants' => $applicants
        ));
    }
    
    private function createFormSearch()
    {
        $builder = $this
          ->createFormBuilder()
          ->add('search', TextType::class, array(
                'label' => "Recherche :" 
          ))
          ->add('submit', SubmitType::class, array(
                'label' => 'Rechercher' 
          ));        
        return $builder->getForm();
    }
}