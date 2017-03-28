<?php

namespace CVThequeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CVThequeController extends Controller
{
    public function indexAction()
    {
        return $this->render('CVThequeBundle:CVTheque:index.html.twig');
    }
}