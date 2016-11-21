<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Alumnos;
use AppBundle\Form\AlumnosType;

/**
 * Alumnos controller.
 *
 * @Route("/alumnos")
 */
class AlumnosController extends Controller
{
    /**
     * Lists all Alumnos entities.
     *
     * @Route("/", name="alumnos_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $catedra = getIdcatedra($this,$em);
        if (isset($catedra)) {    
            $comision = $em->getRepository('AppBundle:Comisiones')->findOneById($_GET['id']);
             if (isset($comision)) {
                $curso = $comision->getIdcurso();
                if ( $curso->getIdcatedra()->getId() == $catedra) {
                           $inscriptos = $comision->getAlumnos();
                       } else $inscriptos = '';
            } else $inscriptos = '';   
        } else $inscriptos = '';
        //var_dump($alumnos);die();
        return $this->render('alumnos/index.html.twig', array(
            'inscriptos' => $inscriptos,'comision'=>$_GET['id'],
            ));
    }

    /**
     * Creates a new Alumnos entity.
     *
     * @Route("/new", name="alumnos_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $alumno = new Alumnos();
        $form = $this->createForm('AppBundle\Form\AlumnosType', $alumno);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($alumno);
            $em->flush();

            return $this->redirectToRoute('alumnos_show', array('id' => $alumno->getId()));
        }

        return $this->render('alumnos/new.html.twig', array(
            'alumno' => $alumno,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Alumnos entity.
     *
     * @Route("/{id}", name="alumnos_show")
     * @Method("GET")
     */
    public function showAction(Alumnos $alumno)
    {
        $deleteForm = $this->createDeleteForm($alumno);

        return $this->render('alumnos/show.html.twig', array(
            'alumno' => $alumno,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Alumnos entity.
     *
     * @Route("/{id}/edit", name="alumnos_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Alumnos $alumno)
    {
        $deleteForm = $this->createDeleteForm($alumno);
        $editForm = $this->createForm('AppBundle\Form\AlumnosType', $alumno);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($alumno);
            $em->flush();

            return $this->redirectToRoute('alumnos_edit', array('id' => $alumno->getId()));
        }

        return $this->render('alumnos/edit.html.twig', array(
            'alumno' => $alumno,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Alumnos entity.
     *
     * @Route("/{id}", name="alumnos_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Alumnos $alumno)
    {
        $form = $this->createDeleteForm($alumno);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($alumno);
            $em->flush();
        }

        return $this->redirectToRoute('alumnos_index');
    }

    /**
     * Creates a form to delete a Alumnos entity.
     *
     * @param Alumnos $alumno The Alumnos entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Alumnos $alumno)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('alumnos_delete', array('id' => $alumno->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
