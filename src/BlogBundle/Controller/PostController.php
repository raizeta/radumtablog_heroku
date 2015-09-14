<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use EntitasBundle\Entity\Posts;
use EntitasBundle\Entity\Komentar;
use EntitasBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
class PostController extends Controller
{
    public function indexAction(Request $request)
    {
        $paginator  = $this->get('knp_paginator');
        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery("SELECT p,k,u FROM EntitasBundle:Posts p
                                                JOIN p.kategori k
                                                JOIN p.penulis u");     
        $entities = $query->getScalarResult();
        $pagination = $paginator->paginate($entities,$request->query->getInt('page', 1),5);

        return $this->render('BlogBundle:Post:index.html.twig', array('entities' => $pagination));
    }


    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        
        $ada = $em->getRepository('EntitasBundle:Posts')->findOneBy(array('slug'=>$slug));
        $hits = $ada->getHits();
        $hits= $hits + 1;
        $ada->setHits($hits);
        $em->persist($ada);
        $em->flush();

        $query = $em->createQuery("SELECT u,p,k FROM EntitasBundle:Posts p 
                                                JOIN p.kategori k
                                                JOIN p.penulis u WHERE (p.slug=:slug)"); 
                $query->setParameter('slug',$slug);

        $entity = $query->getScalarResult();

        $komentar = $em->createQuery("SELECT u,p,k FROM EntitasBundle:Komentar k 
                                                JOIN k.postingan p
                                                JOIN k.pengkomen u WHERE (p.slug=:slug)"); 
                $komentar->setParameter('slug',$slug);
        $komentar = $komentar->getScalarResult();
        $jlhkomentar=count($komentar);
 
        return $this->render('BlogBundle:Post:show.html.twig', array(
            'entity'      => $entity,'komentar'=>$komentar,'jlhkomentar'=>$jlhkomentar,'slug'=>$slug));
    }

    public function showByPenulisAction(Request $request, $penulis)
    {
        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery("SELECT u,p,k FROM EntitasBundle:Posts p
                                                JOIN p.kategori k 
                                                JOIN p.penulis u WHERE (u.username=:penulis)"); 
                $query->setParameter('penulis',$penulis);
            
        $entity = $query->getScalarResult();
        return $this->render('BlogBundle:Post:showby.html.twig', array(
            'entity'      => $entity
        ));
    }

    public function showByKategoriAction(Request $request, $kategori)
    {
        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery("SELECT u,p,k FROM EntitasBundle:Posts p
                                                JOIN p.kategori k 
                                                JOIN p.penulis u WHERE (k.namaKategori=:kategori)"); 
                $query->setParameter('kategori',$kategori);
            
        $entity = $query->getScalarResult();
        return $this->render('BlogBundle:Post:showby.html.twig', array(
            'entity'      => $entity
        ));
    }

    public function mostrecentAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery("SELECT p FROM EntitasBundle:Posts p"); 
        $query->setMaxResults(5);           
        $entity = $query->getResult();

        return $this->render('BlogBundle:Post:mostrecent.html.twig', array(
            'entity'      => $entity
        ));
    }

    public function mostkomentarAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $komentar = $em->createQuery("SELECT u,p,k FROM EntitasBundle:Komentar k 
                                                JOIN k.postingan p
                                                JOIN k.pengkomen u order by k.id desc"); 
        $komentar->setMaxResults(5);

        $entity = $komentar->getScalarResult();

        return $this->render('BlogBundle:Post:mostkomentar.html.twig', array(
            'entity'      => $entity
        ));
    }

    public function insertkomentarAction(Request $request, $slug)
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository('EntitasBundle:Posts')->findOneBy(array('slug' => $slug));
        if (!$posts) 
        {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }


        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') 
        {  
            $isikomen = $request->get('isikomen');

            $komentar = new Komentar();
            $komentar->setCreateAt(new \DateTime('now'));
            $komentar->setUpdateAt(new \DateTime('now'));
            $komentar->setPengkomen($this->getUser());
            $komentar->setIsikomen($isikomen);
            $komentar->setPostingan($posts);

            $em->persist($komentar);
            $em->flush();
            
            #return $this->redirect($this->generateUrl('blog_show', array('slug' => $slug)));
        }
        $komentar = $em->createQuery("SELECT u,p,k FROM EntitasBundle:Komentar k 
                                                JOIN k.postingan p
                                                JOIN k.pengkomen u WHERE (p.slug=:slug)"); 
                $komentar->setParameter('slug',$slug);
        $komentar = $komentar->getScalarResult();
        $jlhkomentar=count($komentar);
        $template=$this->renderView('BlogBundle:Post:ajaxkomentar.html.twig',array('komentar'=>$komentar,'jlhkomentar'=>$jlhkomentar));

        return new JsonResponse(array('message' => $template), 200);
    }
    
}
