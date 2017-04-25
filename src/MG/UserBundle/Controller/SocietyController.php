<?php
namespace MG\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Form;
use JMS\SecurityExtraBundle\Annotation\Secure;

class SocietyController extends Controller
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
        return $this->render('MGUserBundle:Profile:Society_show.html.twig', array(
                'user' => $user,
        ));
    }
    
    /**
     * @Secure(roles="ROLE_ADMIN")
     */    
    public function listAction($page)
    {
        // app/config/parameters.yml
        $nbrByPage = 5;//$this->container->getParameter('cvtheque.nbr_by_page');
        $societys = $this->getSocietys($page, $nbrByPage, true);
        return $this->render('MGUserBundle:Admin:societys.html.twig', array(
            'societys' => $societys,
            'page'     => $page,
            'nb_page'  => ceil(count($societys) / $nbrByPage) ? : 1
        ));
    }
    
    /**
     * @Secure(roles="ROLE_ADMIN")
     */    
    public function listNotValidateAction($page)
    {
        // app/config/parameters.yml
        $nbrByPage = 5;//$this->container->getParameter('cvtheque.nbr_by_page');
        $societys = $this->getSocietys($page, $nbrByPage, false);
        return $this->render('MGUserBundle:Admin:societys.html.twig', array(
            'societys' => $societys,
            'page'     => $page,
            'nb_page'  => ceil(count($societys) / $nbrByPage) ? : 1
        ));
    }
    
    /*
     *
     */
    private function getSocietys($page, $nbrByPage, $validate)
    {
        return $this->getDoctrine()
            ->getManager()
            ->getRepository('MGUserBundle:Society')
            ->getSocietys($nbrByPage, $page, $validate);
    }
}