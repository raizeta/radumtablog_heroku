<?php

namespace BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
class ListController extends Controller
{
    public function listpostAction(Request $request)
    {
    	$paginator  = $this->get('knp_paginator');
        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery("SELECT p,k,u FROM EntitasBundle:Posts p
                                                JOIN p.kategori k
                                                JOIN p.penulis u order by p.id asc");     
        $entities = $query->getScalarResult();
        $pagination = $paginator->paginate($entities,$request->query->getInt('page', 1),5);

        return $this->render('BackBundle:List:listpost.html.twig', 
            array('entities' => $pagination));    
    }

	public function listuserAction(Request $request)
    {
    	$paginator  = $this->get('knp_paginator');
        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery("SELECT u FROM EntitasBundle:User u order by u.id asc");     
        $entities = $query->getResult();
        $pagination = $paginator->paginate($entities,$request->query->getInt('page', 1),5);

        return $this->render('BackBundle:List:listuser.html.twig', array('entities' => $pagination));    
    }

    public function listkategoriAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery("SELECT c FROM EntitasBundle:Kategori c order by c.id asc");     
        $entities = $query->getResult();

        return $this->render('BackBundle:List:listkategori.html.twig', array('entities' => $entities));    
    }

    public function listkomentarAction(Request $request)
    {
        $paginator  = $this->get('knp_paginator');
        $em = $this->getDoctrine()->getManager();

        $komentar = $em->createQuery("SELECT u,p,k FROM EntitasBundle:Komentar k 
                                                JOIN k.postingan p
                                                JOIN k.pengkomen u");      
        $entities = $komentar->getScalarResult();
        $pagination = $paginator->paginate($entities,$request->query->getInt('page', 1),10);

        return $this->render('BackBundle:List:listkomentar.html.twig', array('entities' => $pagination));    
    }

    public function listvisitorAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $komentar = $em->createQuery("SELECT v FROM EntitasBundle:Visitor v");      
        $entities = $komentar->getResult();
        return $this->render('BackBundle:List:listvisitor.html.twig', array('entities' => $entities));    
    }

}
