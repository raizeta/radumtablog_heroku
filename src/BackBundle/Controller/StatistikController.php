<?php

namespace BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use EntitasBundle\Entity\Visitor;
class StatistikController extends Controller
{

    public function delvisitorAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('EntitasBundle:Visitor')->find($id);

        if (!$entity) 
        {
            throw $this->createNotFoundException('Unable to find Visitor entity.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('list_visitor'));
    }

    public function datatableAction()
    {
        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery("SELECT p,k,u FROM EntitasBundle:Posts p
                                                JOIN p.kategori k
                                                JOIN p.penulis u order by p.id asc");     
        $entities = $query->getScalarResult();

        return $this->render('BackBundle:List:datatable.html.twig',array('entities'=>$entities));
    }


}
