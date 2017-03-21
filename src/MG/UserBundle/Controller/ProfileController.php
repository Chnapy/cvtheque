<?php

namespace MG\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Form;
use FOS\UserBundle\Controller\ProfileController as BaseController;
use FOS\UserBundle\Model\UserInterface;
use MG\UserBundle\Entity\Image;
use MG\UserBundle\Form\PhotoType;


class ProfileController extends BaseController
{
    public function visiteAction($slug)
    {
        $repository = $this->getDoctrine()
        ->getManager()
        ->getRepository('MGUserBundle:User');
        
        $user = $repository->findOneBySlug($slug);
        return $this->render('MGUserBundle:Profile:show.html.twig', array(
                'user' => $user,
        ));
    }
    
    public function deleteAction(Request $request)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        
        // Formulaire vide, avec champ CSRF
        $form = $this->createFormBuilder()->getForm();
        
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
        
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
            $this->get('session')->getFlashBag()->add('info', 'Votre profil a été supprimé');
            return $this->redirect($this->generateUrl('mgblog_home'));
        }
        return $this->render('MGUserBundle:Profile:delete.html.twig', array(
                'user' => $user,
                'form' => $form->createView()
        ));
    }
    
    public function pictureEditAction(Request $request, Form $form = null)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        
        if (null === $form) {
            $form = $this->createForm(PhotoType::class, new Image());
        }
        
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $user->setImage($form->getData());
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirect($this->generateUrl('fos_user_profile_show'));
        }
        return $this->render('MGUserBundle:Profile:picture_edit.html.twig', array(
                'user' => $user,
                'form' => $form->createView()
        ));
    }

}