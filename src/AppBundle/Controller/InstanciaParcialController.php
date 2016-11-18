<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\InstanciaParcial;
use AppBundle\Form\InstanciaParcialType;

/**
 * InstanciaParcial controller.
 *
 * @Route("/instanciaparcial")
 */
class InstanciaParcialController extends Controller
{
    /**
     * Lists all InstanciaParcial entities.
     *
     * @Route("/", name="instanciaparcial_index")
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
        if(isset($_GET['id'])) $id = $_GET['id'];
        else $id = 0;
        if (isset($catedra)) {    
            $parcial = $em->getRepository('AppBundle:Parcial')->findOneById($id);
             if (isset($parcial)) {
                $curso = $parcial->getCursada();
                if ( $curso->getIdcatedra()->getId() == $catedra ){
                           $instanciaParcials = $em->getRepository('AppBundle:InstanciaParcial')->findByParcial($id);
                       } else $instanciaParcials = '';
            } else $instanciaParcials = '';   
        } else $instanciaParcials = '';

        return $this->render('instanciaparcial/index.html.twig', array(
            'instanciaParcials' => $instanciaParcials,
            'secretario' => $secretario,
            'parcial' => $id
        ));
    }

    /**
     * Creates a new InstanciaParcial entity.
     *
     * @Route("/new", name="instanciaparcial_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $instanciaParcial = new InstanciaParcial();
        $form = $this->createForm('AppBundle\Form\InstanciaParcialType', $instanciaParcial);
        $form->handleRequest($request);
        if(isset($_GET['id'])) $id = $_GET['id'];
        else $id = 0;
        if ($form->isSubmitted() && $form->isValid() && $id != 0) {
            $em = $this->getDoctrine()->getManager();
            $catedra = getIdCatedra($this,$em); //buscamos la catedra del usuario activo
            $instanciaParcial->setParcial($em->getRepository('AppBundle:Parcial')->findOneById($id));
            $em->persist($instanciaParcial);
            $em->flush();

            return $this->redirectToRoute('instanciaparcial_show', array('id' => $instanciaParcial->getId()));
        }

        return $this->render('instanciaparcial/new.html.twig', array(
            'instanciaParcial' => $instanciaParcial,
            'form' => $form->createView(),
            'parcial' => $id
        ));
    }

    /**
     * Finds and displays a InstanciaParcial entity.
     *
     * @Route("/{id}", name="instanciaparcial_show")
     * @Method("GET")
     */
    public function showAction(InstanciaParcial $instanciaParcial)
    {
        $deleteForm = $this->createDeleteForm($instanciaParcial);

        return $this->render('instanciaparcial/show.html.twig', array(
            'instanciaParcial' => $instanciaParcial,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing InstanciaParcial entity.
     *
     * @Route("/{id}/edit", name="instanciaparcial_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, InstanciaParcial $instanciaParcial)
    {
        $deleteForm = $this->createDeleteForm($instanciaParcial);
        $editForm = $this->createForm('AppBundle\Form\InstanciaParcialType', $instanciaParcial);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($instanciaParcial);
            $em->flush();

            return $this->redirectToRoute('instanciaparcial_edit', array('id' => $instanciaParcial->getId()));
        }

        return $this->render('instanciaparcial/edit.html.twig', array(
            'instanciaParcial' => $instanciaParcial,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a InstanciaParcial entity.
     *
     * @Route("/{id}", name="instanciaparcial_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, InstanciaParcial $instanciaParcial)
    {
        $form = $this->createDeleteForm($instanciaParcial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($instanciaParcial);
            $em->flush();
        }

        return $this->redirectToRoute('instanciaparcial_index');
    }

    /**
     * Creates a form to delete a InstanciaParcial entity.
     *
     * @param InstanciaParcial $instanciaParcial The InstanciaParcial entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(InstanciaParcial $instanciaParcial)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('instanciaparcial_delete', array('id' => $instanciaParcial->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
