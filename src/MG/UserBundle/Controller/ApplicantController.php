<?php
namespace MG\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Form;
use JMS\SecurityExtraBundle\Annotation\Secure;

class ApplicantController extends Controller
{
    
    /**
     * @Secure(roles="ROLE_ADMIN")
     */
    public function validateAction($slug)
    {
        $repository = $this->getDoctrine()
        ->getManager()
        ->getRepository('MGUserBundle:User');
        
        $user = $repository->findOneBySlug($slug);
        $user->permuteValidation();
        $userManager = $this->get('fos_user.user_manager');
        $userManager->updateUser($user);
        return $this->render('MGUserBundle:Profile:applicant_show.html.twig', array(
                'user' => $user,
        ));
    }
    
    /**
     * @Secure(roles="ROLE_ADMIN")
     */    
    public function listValidateAction($page)
    {
        // app/config/parameters.yml
        $nbrByPage = 5;//$this->container->getParameter('cvtheque.nbr_by_page');
        $applicants = $this->getApplicants($page, $nbrByPage, true);
        return $this->render('MGUserBundle:Admin:is_validate_applicants.html.twig', array(
            'applicants' => $applicants,
            'page'     => $page,
            'nb_page'  => ceil(count($applicants) / $nbrByPage) ? : 1
        ));
    }
    
    /**
     * @Secure(roles="ROLE_ADMIN")
     */    
    public function listNotValidateAction($page)
    {
        // app/config/parameters.yml
        $nbrByPage = 5;//$this->container->getParameter('cvtheque.nbr_by_page');
        $applicants = $this->getApplicants($page, $nbrByPage, false);
        return $this->render('MGUserBundle:Admin:is_not_validate_applicants.html.twig', array(
            'applicants' => $applicants,
            'page'     => $page,
            'nb_page'  => ceil(count($applicants) / $nbrByPage) ? : 1
        ));
    }
    
    /*
     *
     */
    private function getApplicants($page, $nbrByPage, $validate)
    {
        
  
        return $this->getDoctrine()
            ->getManager()
            ->getRepository('MGUserBundle:Applicant')
            ->getApplicants($nbrByPage, $page, $validate);
    }
}