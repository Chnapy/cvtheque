<?php
// src/CVThequeBundle/Controller/BlogController.php

namespace CVThequeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\SecurityExtraBundle\Annotation\Secure;
use CVThequeBundle\Entity\Advertisement;
use CVThequeBundle\Entity\Categorie;
use CVThequeBundle\Entity\AdvertSkill;
use CVThequeBundle\Form\AdvertisementType;
use CVThequeBundle\Form\AdvertisementEditType;

class AdvertController extends Controller
{
  public function showAction(Advertisement $advertisement, Request $request)
  {
      
      $author = $advertisement->getSociety();
      
      
      
      
      
      // Formulaire permettant à un admin de suggérer l’annonce à un étudiant
      $builder = $this
          ->createFormBuilder()
          ->add('pseudo', TextType::class, array(
                'label' => "Entrez le pseudo de l'étudiant:" 
          ))
          ->add('submit', SubmitType::class, array(
                'label' => 'Envoyer' 
          ));        
      $form = $builder->getForm();
      // Si le visiteur est l'auteur ou un admin
      if(get_class($this->getUser()) === "MG\UserBundle\Entity\Admin" || $this->getUser() === $author)
      {
          $form->handleRequest($request);
          if ($form->isSubmitted()) {
              $slug = $form['pseudo']->getData();
              $repository = $this->getDoctrine()
              ->getManager()
              ->getRepository('MGUserBundle:User');
              
              $user = $repository->findOneBySlug($slug);
              if(get_class($user) === "MG\UserBundle\Entity\Applicant") {
                  $user->addAdvertisement($advertisement);
                  $em = $this->getDoctrine()->getManager();
                  $em->persist($user);
                  $em->flush();
                  $this->get('session')->getFlashBag()->add('info', "Une invitation à consulter cette annonce a été envoyé à ".$user->getUsername());
              }
          }
      }
      return $this->render('CVThequeBundle:Advertisement:view.html.twig', array(
          'advertisement' => $advertisement,
          'author'        => $author,
          'form'          => $form->createView()
      ));
  }

  /**
   * @Secure(roles="ROLE_SOCIETY")
   */
  public function addAction(Request $request)
  {
    $advertisement = new Advertisement();
    if ($this->getUser()) {
      $advertisement->setSociety($this->getUser());
    }

    $form = $this->createForm(AdvertisementType::class, $advertisement);
    
    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($advertisement);
        $em->flush();
        $this->get('session')->getFlashBag()->add('info', 'Annonce enregistré');
        return $this->redirect($this->generateUrl('show_advert', array('slug' => $advertisement->getSlug())));
    }
    return $this->render('CVThequeBundle:Advertisement:add.html.twig', array(
      'form' => $form->createView(),
    ));
  }

  /**
   * @Secure(roles="ROLE_SOCIETY")
   */
  public function updateAction(Advertisement $advertisement, Request $request)
  {
      $originalAdvertSkills = new ArrayCollection();
      // Create an ArrayCollection of the current AdvertSkill objects in the database
      foreach ($advertisement->getAdvertSkills() as $advertSkill) {
          $originalAdvertSkills->add($advertSkill);
      }
      $form = $this->createForm(AdvertisementEditType::class, $advertisement);
    
      if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
        $em = $this->getDoctrine()->getManager();
        
        foreach ($originalAdvertSkills as $advertSkill) {
            if (false === $advertisement->getAdvertSkills()->contains($advertSkill)) {
                // remove the Advertisement from the AdvertSkill
                $advertSkill->setAdvertisement(null);
            }
        }
        $em->persist($advertisement);
        $em->flush();
        $this->get('session')->getFlashBag()->add('info', 'Annonce modifiée');
        return $this->redirect($this->generateUrl('show_advert', array('slug' => $advertisement->getSlug())));
      }
      return $this->render('CVThequeBundle:Advertisement:update.html.twig', array(
      'form'    => $form->createView(),
      'advertisement' => $advertisement
      ));
  }

  /**
   * @Secure(roles="ROLE_ADMIN")
   */
  public function deleteAction(Advertisement $advertisement, Request $request)
  {
    // Création d'un formulaire vide, contenant seulement un champ CSRF
    $form = $this->createFormBuilder()->getForm();

    if ($request->isMethod('POST')) {
      $form->handleRequest($request);

      if ($form->isValid()) { // Vérification du CSRF
        $em = $this->getDoctrine()->getManager();
        $em->remove($advertisement);
        $em->flush();
        $this->get('session')->getFlashBag()->add('info', 'Advertisement supprimé');
        return $this->redirect($this->generateUrl('mgblog_home'));
      }
    }

    // Si la méthode est GET, affichage d'une page de confirmation
    return $this->render('CVThequeBundle:Advertisement:delete.html.twig', array(
      'advertisement' => $advertisement,
      'form'    => $form->createView()
    ));
  }
    
    /**
    * @Secure(roles="ROLE_ADMIN")
    */    
    public function listAdvertAction($page)
    {
        // app/config/parameters.yml
        $nbrByPage = 5;//$this->container->getParameter('mgblog.nbr_by_page');
  
        $advertisements = $this->getDoctrine()
        ->getManager()
        ->getRepository('CVThequeBundle:Advertisement')
        ->getAdvertisements($nbrByPage, $page);
  
        return $this->render('CVThequeBundle:Admin:adverts.html.twig', array(
            'advertisements' => $advertisements,
            'page'     => $page,
            'nb_page'  => ceil(count($advertisements) / $nbrByPage) ? : 1
        ));
    }
}