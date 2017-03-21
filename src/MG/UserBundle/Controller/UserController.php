<?php

namespace MG\UserBundle\Controller;

use MG\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
 * User controller.
 *
 */
class UserController extends Controller
{
    /**
     * Lists all user entities.
     *
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('MGUserBundle:User')->findAll();

        return $this->render('MGUserBundle:User:list.html.twig', array(
            'users' => $users,
        ));
    }

    /**
     * Finds and displays a user entity.
     *
     */
    public function showAction(User $user)
    {

        return $this->render('MGUserBundle:User/show.html.twig', array(
            'user' => $user,
        ));
    }
}
