<?php

namespace PDFBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EntitasBundle:Posts')->findOneBy(array('slug' => $slug));
        if (!$entity) 
        {
            throw $this->createNotFoundException('Unable to find Posts entity.');
        }

        $html = $this->renderView('PDFBundle:Default:index.html.twig',array('entity'=>$entity));
        $pdfgenerator= $this->get('knp_snappy.pdf');

		return new Response($pdfgenerator->getOutputFromHtml($html),200,
    		array('Content-Type'          => 'application/pdf',
    			'Content-Disposition'   => 'inline; filename="matapelajaran.pdf"'));
    }
}
