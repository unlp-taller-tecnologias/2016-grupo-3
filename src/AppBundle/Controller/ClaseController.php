<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Clase;
use AppBundle\Form\ClaseType;

/**
 * Clase controller.
 *
 * @Route("/clase")
 */
class ClaseController extends Controller
{
    /**
     * Lists all Clase entities.
     *
     * @Route("/", name="clase_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        //$catedra = $this->getUser()->getCatedra();
        $catedra = getIdCatedra($this,$em);
        if (esSecretario($this)) {
            $secretario=true;
        }else{
            $secretario=false;
        }
        if (isset($catedra)) {    
            $curso = $em->getRepository('AppBundle:Cursos')->findOneById($_GET['id']);
             if (isset($curso)) {
                if ( $curso->getIdcatedra()->getId() == $catedra ){
                           $clases = $em->getRepository('AppBundle:Clase')->findByCursada($_GET['id']);
                       } else $clases = '';
            } else $clases = '';   
        } else $clases = '';
        return $this->render('clase/index.html.twig', array(
            'clases' => $clases, 'secretario' => $secretario
            ));
    }

    /**
     * Creates a new Clase entity.
     *
     * @Route("/new", name="clase_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $clase = new Clase();
        $form = $this->createForm('AppBundle\Form\ClaseType', $clase);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $catedra = getIdCatedra($this,$em); //buscamos la clase del usuario activo
            $clase->setCursada($em->getRepository('AppBundle:Cursos')->findOneBy( array('idcatedra'=>$catedra),
                           array('id' => 'DESC')));
            $em->persist($clase);
            $em->flush();

            return $this->redirectToRoute('clase_show', array('id' => $clase->getId()));
        }

        return $this->render('clase/new.html.twig', array(
            'clase' => $clase,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Clase entity.
     *
     * @Route("/{id}", name="clase_show")
     * @Method("GET")
     */
    public function showAction(Clase $clase)
    {
        $deleteForm = $this->createDeleteForm($clase);

        return $this->render('clase/show.html.twig', array(
            'clase' => $clase,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Clase entity.
     *
     * @Route("/{id}/edit", name="clase_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Clase $clase)
    {
        $deleteForm = $this->createDeleteForm($clase);
        $editForm = $this->createForm('AppBundle\Form\ClaseType', $clase);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($clase);
            $em->flush();

            return $this->redirectToRoute('clase_edit', array('id' => $clase->getId()));
        }

        return $this->render('clase/edit.html.twig', array(
            'clase' => $clase,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Clase entity.
     *
     * @Route("/{id}", name="clase_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Clase $clase)
    {
        $form = $this->createDeleteForm($clase);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($clase);
            $em->flush();
        }

        return $this->redirectToRoute('clase_index');
    }

    /**
     * Creates a form to delete a Clase entity.
     *
     * @param Clase $clase The Clase entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Clase $clase)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('clase_delete', array('id' => $clase->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
