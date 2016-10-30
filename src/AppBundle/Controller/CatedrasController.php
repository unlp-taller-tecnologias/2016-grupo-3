<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Catedras;
use AppBundle\Form\CatedrasType;

/**
 * Catedras controller.
 *
 * @Route("/catedras")
 */
class CatedrasController extends Controller
{
    /**
     * Lists all Catedras entities.
     *
     * @Route("/", name="catedras_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $catedras = $em->getRepository('AppBundle:Catedras')->findAll();

        return $this->render('catedras/index.html.twig', array(
            'catedras' => $catedras,
        ));
    }

    /**
     * Creates a new Catedras entity.
     *
     * @Route("/new", name="catedras_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $catedra = new Catedras();
        $form = $this->createForm('AppBundle\Form\CatedrasType', $catedra);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($catedra);
            $em->flush();

            return $this->redirectToRoute('catedras_show', array('id' => $catedra->getId()));
        }

        return $this->render('catedras/new.html.twig', array(
            'catedra' => $catedra,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Catedras entity.
     *
     * @Route("/{id}", name="catedras_show")
     * @Method("GET")
     */
    public function showAction(Catedras $catedra)
    {
        $deleteForm = $this->createDeleteForm($catedra);

        return $this->render('catedras/show.html.twig', array(
            'catedra' => $catedra,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Catedras entity.
     *
     * @Route("/{id}/edit", name="catedras_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Catedras $catedra)
    {
        $deleteForm = $this->createDeleteForm($catedra);
        $editForm = $this->createForm('AppBundle\Form\CatedrasType', $catedra);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($catedra);
            $em->flush();

            return $this->redirectToRoute('catedras_edit', array('id' => $catedra->getId()));
        }

        return $this->render('catedras/edit.html.twig', array(
            'catedra' => $catedra,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Catedras entity.
     *
     * @Route("/{id}", name="catedras_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Catedras $catedra)
    {
        $form = $this->createDeleteForm($catedra);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($catedra);
            $em->flush();
        }

        return $this->redirectToRoute('catedras_index');
    }

    /**
     * Creates a form to delete a Catedras entity.
     *
     * @param Catedras $catedra The Catedras entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Catedras $catedra)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('catedras_delete', array('id' => $catedra->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
