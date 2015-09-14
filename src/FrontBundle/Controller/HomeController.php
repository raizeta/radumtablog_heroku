<?php

namespace FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use EntitasBundle\Entity\Visitor;
use Symfony\Component\HttpFoundation\Request;
class HomeController extends Controller
{
    public function indexAction(Request $request)
    {
        $ip=$this->container->get('request_stack')->getCurrentRequest()->getClientIp();
        $entity = new Visitor();
        $entity->setIpAddress($ip);
        $entity->setCreateAt(new \DateTime('now'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($entity);
        $em->flush();

        return $this->render('FrontBundle:Home:index.html.twig', array());    
    }

    public function resumeAction()
    {
        return $this->render('FrontBundle:Home:resume.html.twig', array());    
    }

    public function cobaajaxAction()
    {
        return $this->render('FrontBundle:Home:cobaajax.html.twig', array());    
    }
}
