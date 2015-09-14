<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class KategoriController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery("SELECT k FROM EntitasBundle:Kategori k");
		$entities = $query->getResult();
        return $this->render('BlogBundle:Kategori:index.html.twig', 
        	array('entities'=>$entities));    
    }

}
