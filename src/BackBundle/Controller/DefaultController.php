<?php

namespace BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use EntitasBundle\Entity\Posts;
use EntitasBundle\Form\PostsType;

use EntitasBundle\Entity\Komentar;
use EntitasBundle\Form\KomentarType;

use EntitasBundle\Entity\Kategori;
use EntitasBundle\Form\KategoriType;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $dqluser = $em->createQuery("SELECT u FROM EntitasBundle:User u");
        $users = $dqluser->getResult();
        $jlhuser=count($users);

        $dqlpost = $em->createQuery("SELECT p FROM EntitasBundle:Posts p");
        $post = $dqlpost->getResult();
        $jlhpost=count($post);

        $dqlkategori = $em->createQuery("SELECT k FROM EntitasBundle:Kategori k");
        $kategori = $dqlkategori->getResult();
        $jlhkategori=count($kategori);

        $dqlkomentar = $em->createQuery("SELECT c FROM EntitasBundle:Komentar c");
        $komentar = $dqlkomentar->getResult();
        $jlhkomentar=count($komentar);

		$post = new Posts();
        $post->setVisible(true);


        $form_post = $this->createForm(new PostsType(), $post, array(
        'action' => $this->generateUrl('create_post'),
        'method' => 'POST'));

        $kategori = new Kategori();

        $form_kategori = $this->createForm(new KategoriType(), $kategori, array(
        'action' => $this->generateUrl('create_kategori'),
        'method' => 'POST'));

        return $this->render('BackBundle:Default:index.html.twig',
        	array(
	        		'form_post'=>$form_post->createView(),
                    'form_kategori'=>$form_kategori->createView(),
	    			'jlhuser'=>$jlhuser,'jlhpost'=>$jlhpost,
	        		'jlhkategori'=>$jlhkategori,'jlhkomentar'=>$jlhkomentar)
    			  );
    }
}
