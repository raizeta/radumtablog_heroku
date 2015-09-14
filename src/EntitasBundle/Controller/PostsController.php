<?php

namespace EntitasBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use EntitasBundle\Entity\Posts;
use EntitasBundle\Form\PostsType;

/**
 * Posts controller.
 *
 */
class PostsController extends Controller
{

    /**
     * Lists all Posts entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EntitasBundle:Posts')->findAll();

        return $this->render('EntitasBundle:Posts:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Posts entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Posts();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) 
        {

            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('posts_show', array('id' => $entity->getId())));
        }

        return $this->render('EntitasBundle:Posts:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Posts entity.
     *
     * @param Posts $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Posts $entity)
    {
        $form = $this->createForm(new PostsType(), $entity, array(
            'action' => $this->generateUrl('posts_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Posts entity.
     *
     */
    public function newAction()
    {
        $entity = new Posts();
        $form   = $this->createCreateForm($entity);

        return $this->render('EntitasBundle:Posts:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Posts entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EntitasBundle:Posts')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Posts entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EntitasBundle:Posts:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Posts entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EntitasBundle:Posts')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Posts entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EntitasBundle:Posts:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Posts entity.
    *
    * @param Posts $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Posts $entity)
    {
        $form = $this->createForm(new PostsType(), $entity, array(
            'action' => $this->generateUrl('posts_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Posts entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EntitasBundle:Posts')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Posts entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('posts_edit', array('id' => $id)));
        }

        return $this->render('EntitasBundle:Posts:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Posts entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EntitasBundle:Posts')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Posts entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('posts'));
    }

    /**
     * Creates a form to delete a Posts entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('posts_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
