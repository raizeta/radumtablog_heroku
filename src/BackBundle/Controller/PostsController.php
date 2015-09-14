<?php

namespace BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use EntitasBundle\Entity\Posts;
use EntitasBundle\Form\PostsType;

class PostsController extends Controller
{
    public function newPostAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entity = new Posts();

        $entity->setVisible(true);

        $form = $this->createForm(new PostsType(), $entity, array(
        'action' => $this->generateUrl('create_post'),
        'method' => 'POST'));

        return $this->render('BackBundle:Posts:new.html.twig', 
            array('entity'=> $entity,
                  'form'=> $form->createView()
                  ));    
    }

    public function createAction(Request $request)
    {
        $entity = new Posts();
        $form = $this->createForm(new PostsType(),$entity);
        $form->handleRequest($request);

        if ($form->isValid()) 
        {
            $em = $this->getDoctrine()->getManager();

            $entity->setPenulis($this->getUser());
            $entity->setCreateAt(new \DateTime('now'));
            $entity->setUpdateAt(new \DateTime('now'));
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('list_post'));
        }

        return $this->render('BackBundle:Posts:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function editPostAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('EntitasBundle:Posts')->findOneBy(array('slug'=>$slug));
        if (!$entity) 
        {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }

        $editform = $this->createForm(new PostsType(), $entity, array(
        'action' => $this->generateUrl('update_post',array('slug'=>$slug)),
        'method' => 'POST'));

        return $this->render('BackBundle:Posts:editpost.html.twig', 
        	array('entity'=> $entity,
        		  'edit_form'=> $editform->createView()
        		  ));    
    }

    public function updatePostAction(Request $request, $slug)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EntitasBundle:Posts')->findOneBy(array('slug'=>$slug));

        if (!$entity) 
        {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }

        $editform = $this->createForm(new PostsType(), $entity);
        $editform->handleRequest($request);

        if ($editform->isValid()) 
        {
            $em->flush();

            return $this->redirect($this->generateUrl('list_post'));
        }

        return $this->render('BackBundle:Posts:editpost.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editform->createView(),
        ));
    }

    public function deleteAction(Request $request, $slug)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('EntitasBundle:Posts')->findOneBy(array('slug'=>$slug));

        if (!$entity) 
        {
            throw $this->createNotFoundException('Unable to find Posts entity.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('list_post'));
    }

}
