<?php
namespace MG\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Form;
use FOS\UserBundle\Controller\ProfileController as BaseController;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;
use MG\UserBundle\Entity\Image;
use MG\UserBundle\Form\PhotoType;
use MG\UserBundle\Entity\CVFile;
use MG\UserBundle\Form\CVFileType;
use MG\UserBundle\Entity\LogBookFile;
use MG\UserBundle\Form\LogBookFileType;
use Doctrine\Common\Collections\ArrayCollection;

class ProfileController extends BaseController
{
    public function showAction() 
    {
        $user = $this->getUser();
        if(get_class($user) === "MG\UserBundle\Entity\Admin") {
            return $this->render('MGUserBundle:Profile:admin_show.html.twig', array(
                    'user' => $user,
            ));
        } else if(get_class($user) === "MG\UserBundle\Entity\Applicant") {
            return $this->render('MGUserBundle:Profile:applicant_show.html.twig', array(
                    'user' => $user,
            ));
        } else if(get_class($user) === "MG\UserBundle\Entity\Society") {
            return $this->render('MGUserBundle:Profile:society_show.html.twig', array(
                    'user' => $user,
            ));
        }
    }
    
    public function visiteAction($slug)
    {
        $repository = $this->getDoctrine()
        ->getManager()
        ->getRepository('MGUserBundle:User');
        
        $user = $repository->findOneBySlug($slug);
        if(get_class($user) === "MG\UserBundle\Entity\Applicant") {
            
            return $this->render('MGUserBundle:Profile:applicant_show.html.twig', array(
                    'user' => $user,
            ));
        } else if(get_class($user) === "MG\UserBundle\Entity\Society") {
            return $this->render('MGUserBundle:Profile:society_show.html.twig', array(
                    'user' => $user,
            ));
        }
    }
    
    public function editAction(Request $request)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        
        $dispatcher = $this->get('event_dispatcher');

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }
        $originalSkills = new ArrayCollection();
        $originalWorkExperiences = new ArrayCollection();
        $originalSkills = new ArrayCollection();
        $originalHobbies = new ArrayCollection();
        if(get_class($user) === "MG\UserBundle\Entity\Applicant") {
            foreach ($user->getSkills() as $education) {
                $originalSkills->add($education);
            }
            foreach ($user->getWorkExperiences() as $workExperience) {
                $originalWorkExperiences->add($workExperience);
            }
            foreach ($user->getSkills() as $skill) {
                $originalSkills->add($skill);
            }            
            foreach ($user->getHobbies() as $hobby) {
                $originalHobbies->add($hobby);
            }
        }

        
        $formFactory = $this->get('fos_user.profile.form.factory');

        $form = $formFactory->createForm();
        $form->setData($user);


        $form->handleRequest($request);
        if(get_class($user) === "MG\UserBundle\Entity\Admin") {
            if ($form->isSubmitted() && $form->isValid()) {
                /** @var $userManager UserManagerInterface */
                $userManager = $this->get('fos_user.user_manager');

                $event = new FormEvent($form, $request);
                $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_SUCCESS, $event);

                $userManager->updateUser($user);
                if (null === $response = $event->getResponse()) {
                    $url = $this->generateUrl('fos_user_profile_show');
                    $response = new RedirectResponse($url);
                }

                $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

                return $response;
            }

            
            return $this->render('MGUserBundle:Profile:admin.edit.form.html.twig', array(
                    'user' => $user,
                    'form' => $form->createView(),
            ));
        } else if(get_class($user) === "MG\UserBundle\Entity\Applicant") {
            if ($form->isSubmitted() && $form->isValid()) {
                foreach ($originalSkills as $education) {
                    if (false === $user->getSkills()->contains($education)) {
                        $user->removeSkill($education);
                    }
                }
                foreach ($originalWorkExperiences as $workExperience) {
                    if (false === $user->getWorkExperiences()->contains($workExperience)) {
                        $user->removeWorkExperience($workExperience);
                    }
                }
                foreach ($originalSkills as $skill) {
                    if (false === $user->getSkills()->contains($skill)) {
                        $user->removeSkill($skill);
                    }
                }
                foreach ($originalHobbies as $hobby) {
                    if (false === $user->getHobbies()->contains($hobby)) {
                        $user->removeHobby($hobby);
                    }
                }
                $userManager = $this->get('fos_user.user_manager');

                $event = new FormEvent($form, $request);
                $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_SUCCESS, $event);

                $userManager->updateUser($user);
                if (null === $response = $event->getResponse()) {
                    $url = $this->generateUrl('fos_user_profile_show');
                    $response = new RedirectResponse($url);
                }

                $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

                return $response;
            }
            
            
            return $this->render('MGUserBundle:Profile:applicant.edit.form.html.twig', array(
                    'user' => $user,
                    'form' => $form->createView(),
            ));
        } else if(get_class($user) === "MG\UserBundle\Entity\Society") {
            if ($form->isSubmitted() && $form->isValid()) {
                /** @var $userManager UserManagerInterface */
                $userManager = $this->get('fos_user.user_manager');

                $event = new FormEvent($form, $request);
                $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_SUCCESS, $event);

                $userManager->updateUser($user);
                if (null === $response = $event->getResponse()) {
                    $url = $this->generateUrl('fos_user_profile_show');
                    $response = new RedirectResponse($url);
                }

                $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

                return $response;
            }
            
            return $this->render('MGUserBundle:Profile:society.edit.form.html.twig', array(
                    'user' => $user,
                    'form' => $form->createView(),
            ));
        }
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
            return $this->redirect($this->generateUrl('homepage'));
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
    
    public function logBookUploadAction(Request $request, Form $form = null)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        
        if (null === $form) {
            $form = $this->createForm(LogBookFileType::class, $user->getLogBookFile());
        }
        
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $user->setLogBookFile($form->getData());
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirect($this->generateUrl('fos_user_profile_show'));
        }
        return $this->render('MGUserBundle:Profile:log_book_upload.html.twig', array(
                'user' => $user,
                'form' => $form->createView()
        ));
    }
    
    public function cvUploadAction(Request $request, Form $form = null)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        
        if (null === $form) {
            $form = $this->createForm(CVFileType::class, $user->getCvFile());
        }
        
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $user->setCvFile($form->getData());
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirect($this->generateUrl('fos_user_profile_show'));
        }
        return $this->render('MGUserBundle:Profile:cv_upload.html.twig', array(
                'user' => $user,
                'form' => $form->createView()
        ));
    }
}