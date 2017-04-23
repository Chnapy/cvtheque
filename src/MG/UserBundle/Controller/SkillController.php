<?php
namespace MG\UserBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use MG\UserBundle\Entity\Skill;

class SkillController extends Controller
{
    public function getSkillsAction(Request $request)
    {
        $skills = $this->getDoctrine()
        ->getRepository('MGUserBundle:Skill')
        ->findAll();
        
        return $skills;
    }
}