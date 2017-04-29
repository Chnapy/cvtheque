<?php

namespace CVThequeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CVThequeController extends Controller
{
    public function indexAction()
    {
        $user = $this->getUser();
        if ($user === null)
        {
            return $this->render('CVThequeBundle:CVTheque:index.html.twig');
        }
        else
        {
            return $this->redirect($this->generateUrl('mg_user_show'));
        }
    }
}