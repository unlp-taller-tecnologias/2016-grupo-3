<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Comisiones;
use AppBundle\Form\ComisionesType;

/**
 * Comisiones controller.
 *
 * @Route("/comisiones")
 */
class ComisionesController extends Controller
{
    /**
     * Lists all Comisiones entities.
     *
     * @Route("/", name="comisiones_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        //$catedra = $this->getUser()->getCatedra();
        $catedra = getIdCatedra($this,$em);
        $nombreCurso = $em->getRepository('AppBundle:Cursos')->findOneById($_GET['id']);
        //print($nombreCurso);
        //die();
        if (isset($catedra)) {    
            $curso = $em->getRepository('AppBundle:Cursos')->findOneById($_GET['id']);
             if (isset($curso)) {
                if ( $curso->getIdcatedra()->getId() == $catedra ){
                           $comisiones = $em->getRepository('AppBundle:Comisiones')->findByIdcurso($_GET['id']);
                       } else $comisiones = '';
            } else $comisiones = '';   
        } else $comisiones = '';
        return $this->render('comisiones/index.html.twig', array(
            'comisiones' => $comisiones,'cursada' => $_GET['id'], 'nombreCurso' => $nombreCurso
            ));
    }

    /**
     * Creates a new Comisiones entity.
     *
     * @Route("/new", name="comisiones_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $comisione = new Comisiones();
        $form = $this->createForm('AppBundle\Form\ComisionesType', $comisione);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comisione);
            $em->flush();

            return $this->redirectToRoute('comisiones_show', array('id' => $comisione->getId()));
        }

        return $this->render('comisiones/new.html.twig', array(
            'comisione' => $comisione,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Comisiones entity.
     *
     * @Route("/{id}", name="comisiones_show")
     * @Method("GET")
     */
    public function showAction(Comisiones $comisione)
    {
        $deleteForm = $this->createDeleteForm($comisione);

        return $this->render('comisiones/show.html.twig', array(
            'comisione' => $comisione,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Comisiones entity.
     *
     * @Route("/{id}/edit", name="comisiones_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Comisiones $comisione)
    {
        $deleteForm = $this->createDeleteForm($comisione);
        $editForm = $this->createForm('AppBundle\Form\ComisionesType', $comisione);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comisione);
            $em->flush();

            return $this->redirectToRoute('comisiones_edit', array('id' => $comisione->getId()));
        }

        return $this->render('comisiones/edit.html.twig', array(
            'comisione' => $comisione,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Comisiones entity.
     *
     * @Route("/{id}", name="comisiones_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Comisiones $comisione)
    {
        $form = $this->createDeleteForm($comisione);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($comisione);
            $em->flush();
        }

        return $this->redirectToRoute('comisiones_index');
    }

    /**
     * Creates a form to delete a Comisiones entity.
     *
     * @param Comisiones $comisione The Comisiones entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Comisiones $comisione)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('comisiones_delete', array('id' => $comisione->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
