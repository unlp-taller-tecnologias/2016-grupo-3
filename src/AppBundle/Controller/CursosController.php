<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Cursos;
use AppBundle\Form\CursosType;

/**
 * Cursos controller.
 *
 * @Route("/cursos")
 */
class CursosController extends Controller
{
    /**
     * Lists all Cursos entities.
     *
     * @Route("/", name="cursos_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $catedra = getIdCatedra($this,$em);

        if (esSecretario($this)) {
            $secretario=true;
        }else{
            $secretario=false;
        }
        $nombreCatedra = $em->getRepository('AppBundle:Catedras')->findOneById($catedra);
        //$userManager = $this->get('fos_user.user_manager');
        if (isset($catedra)) {
            $cursos = $em->getRepository('AppBundle:Cursos')->findByIdcatedra($catedra);

            return $this->render('cursos/index.html.twig', array(
                'cursos' => $cursos, 'secretario' => $secretario,
            'nombreCatedra' => $nombreCatedra));
        } else {
            return $this->render('cursos/index.html.twig', array(
            'cursos' => '', 'secretario' => $secretario,));
        }
    }

    /**
     * Creates a new Cursos entity.
     *
     * @Route("/new", name="cursos_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $curso = new Cursos();
        $form = $this->createForm('AppBundle\Form\CursosType', $curso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($curso);
            $em->flush();

            return $this->redirectToRoute('cursos_show', array('id' => $curso->getId()));
        }

        return $this->render('cursos/new.html.twig', array(
            'curso' => $curso,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Cursos entity.
     *
     * @Route("/{id}", name="cursos_show")
     * @Method("GET")
     */
    public function showAction(Cursos $curso)
    {
        $deleteForm = $this->createDeleteForm($curso);

        return $this->render('cursos/show.html.twig', array(
            'curso' => $curso,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Cursos entity.
     *
     * @Route("/{id}/edit", name="cursos_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Cursos $curso)
    {
        $deleteForm = $this->createDeleteForm($curso);
        $editForm = $this->createForm('AppBundle\Form\CursosType', $curso);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($curso);
            $em->flush();

            return $this->redirectToRoute('cursos_edit', array('id' => $curso->getId()));
        }

        return $this->render('cursos/edit.html.twig', array(
            'curso' => $curso,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Cursos entity.
     *
     * @Route("/{id}", name="cursos_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Cursos $curso)
    {
        $form = $this->createDeleteForm($curso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($curso);
            $em->flush();
        }

        return $this->redirectToRoute('cursos_index');
    }

    /**
     * Creates a form to delete a Cursos entity.
     *
     * @param Cursos $curso The Cursos entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Cursos $curso)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cursos_delete', array('id' => $curso->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
