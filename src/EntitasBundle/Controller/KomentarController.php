<?php

namespace EntitasBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use EntitasBundle\Entity\Komentar;
use EntitasBundle\Form\KomentarType;

/**
 * Komentar controller.
 *
 */
class KomentarController extends Controller
{

    /**
     * Lists all Komentar entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EntitasBundle:Komentar')->findAll();

        return $this->render('EntitasBundle:Komentar:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Komentar entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Komentar();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('blog_komentar_show', array('id' => $entity->getId())));
        }

        return $this->render('EntitasBundle:Komentar:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Komentar entity.
     *
     * @param Komentar $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Komentar $entity)
    {
        $form = $this->createForm(new KomentarType(), $entity, array(
            'action' => $this->generateUrl('blog_komentar_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Komentar entity.
     *
     */
    public function newAction()
    {
        $entity = new Komentar();
        $entity->setCreateAt(new \DateTime('now'));
        $entity->setUpdateAt(new \DateTime('now'));
        $entity->setPengkomen($this->getUser());
        $form   = $this->createCreateForm($entity);

        return $this->render('EntitasBundle:Komentar:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Komentar entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EntitasBundle:Komentar')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Komentar entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EntitasBundle:Komentar:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Komentar entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EntitasBundle:Komentar')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Komentar entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EntitasBundle:Komentar:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Komentar entity.
    *
    * @param Komentar $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Komentar $entity)
    {
        $form = $this->createForm(new KomentarType(), $entity, array(
            'action' => $this->generateUrl('blog_komentar_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Komentar entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EntitasBundle:Komentar')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Komentar entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('blog_komentar_edit', array('id' => $id)));
        }

        return $this->render('EntitasBundle:Komentar:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Komentar entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EntitasBundle:Komentar')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Komentar entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('blog_komentar'));
    }

    /**
     * Creates a form to delete a Komentar entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('blog_komentar_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
