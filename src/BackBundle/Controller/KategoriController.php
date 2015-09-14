<?php

namespace BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use EntitasBundle\Entity\Kategori;
use EntitasBundle\Form\KategoriType;

class KategoriController extends Controller
{
    public function newAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entity = new Kategori();

        $form = $this->createForm(new KategoriType(), $entity, array(
        'action' => $this->generateUrl('create_kategori'),
        'method' => 'POST'));

        return $this->render('BackBundle:Kategori:new.html.twig', 
            array('entity'=> $entity,
                  'form'=> $form->createView()
                  ));    
    }

    public function createAction(Request $request)
    {
        $entity = new Kategori();
        $form = $this->createForm(new KategoriType(),$entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('list_kategori'));
        }

        return $this->render('BackBundle:Kategori:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function editAction($namakategori)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('EntitasBundle:Kategori')->findOneBy(array('namaKategori'=>$namakategori));
        if (!$entity) 
        {
            throw $this->createNotFoundException('Unable to find Kategori entity.');
        }

        $editform = $this->createForm(new KategoriType(), $entity, array(
        'action' => $this->generateUrl('update_kategori',array('namakategori'=>$namakategori)),
        'method' => 'POST'));

        return $this->render('BackBundle:Kategori:edit.html.twig', 
        	array('entity'=> $entity,
        		  'edit_form'=> $editform->createView()
        		  ));    
    }

    public function updateAction(Request $request, $namakategori)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EntitasBundle:Kategori')->findOneBy(array('namaKategori'=>$namakategori));

        if (!$entity) 
        {
            throw $this->createNotFoundException('Unable to find Kategori entity.');
        }

        $editform = $this->createForm(new KategoriType(), $entity);
        $editform->handleRequest($request);

        if ($editform->isValid()) 
        {
            $em->flush();

            return $this->redirect($this->generateUrl('list_kategori'));
        }

        return $this->render('BackBundle:Kategori:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editform->createView(),
        ));
    }

    public function deleteAction(Request $request, $namakategori)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('EntitasBundle:Kategori')->findOneBy(array('namaKategori'=>$namakategori));

        if (!$entity) 
        {
            throw $this->createNotFoundException('Unable to find Kategori entity.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('list_kategori'));
    }
}
