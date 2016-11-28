<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Parcial;
use AppBundle\Form\ParcialType;

/**
 * Parcial controller.
 *
 * @Route("/parcial")
 */
class ParcialController extends Controller
{
    /**
     * Lists all Parcial entities.
     *
     * @Route("/", name="parcial_index")
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
        if(isset($_GET['idCursada'])) $idCursada = $_GET['idCursada']; 
        else 
            if (isset($_GET['idComision'])) {
                $idCursada = $em->getRepository('AppBundle:Comisiones')->findOneById($_GET['idComision']);
                $idCursada = $idCursada->getIdCurso();
                $idCursada = $idCursada->getId();
            }
            else $idCursada = 0;

        if (isset($catedra)) {    
            $curso = $em->getRepository('AppBundle:Cursos')->findOneById($idCursada);
             if (isset($curso)) {
                if ( $curso->getIdcatedra()->getId() == $catedra ){
                           $parcials = $em->getRepository('AppBundle:Parcial')->findByCursada($idCursada);
                       } else $parcials = '';
            } else $parcials = '';   
        } else $parcials = '';
        if (isset($_GET['idComision'])) {
            return $this->render('parcial/indexNotas.html.twig', array(
                'parcials' => $parcials, 'cursada' => $idCursada, 'idComision' => $_GET['idComision']
                ));
        }else{
            return $this->render('parcial/index.html.twig', array(
            'parcials' => $parcials, 'secretario' => $secretario, 'cursada' => $idCursada));
        }

        
    }

    /**
     * Creates a new Parcial entity.
     *
     * @Route("/new", name="parcial_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {   
        if (esSecretario($this)) {
            $parcial = new Parcial();
            $form = $this->createForm('AppBundle\Form\ParcialType', $parcial);
            $form->handleRequest($request);
            if(isset($_GET['id'])) $id = $_GET['id'];
            else $id = 0;
            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $catedra = getIdCatedra($this,$em); //buscamos la catedra del usuario activo
                $parcial->setCursada($em->getRepository('AppBundle:Cursos')->findOneBy( array('idcatedra'=>$catedra),
                               array('id' => 'DESC')));
                $em->persist($parcial);
                $em->flush();

                return $this->redirectToRoute('parcial_index', array('idCursada' => $parcial->getCursada()->getId()));
            }

            return $this->render('parcial/new.html.twig', array(
                'parcial' => $parcial,
                'form' => $form->createView(),
                'cursada' => $id
            ));
        }else{
            $secretario=false;

            $em = $this->getDoctrine()->getManager();
            $catedra = getIdCatedra($this,$em);

            $cursos = $em->getRepository('AppBundle:Cursos')->findByIdcatedra($catedra);
            $nombreCatedra = $em->getRepository('AppBundle:Catedras')->findOneById($catedra);
            return $this->render('cursos/index.html.twig', array(
                'cursos' => $cursos, 'secretario' => $secretario,
            'nombreCatedra' => $nombreCatedra));
        }
    }

    /**
     * Finds and displays a Parcial entity.
     *
     * @Route("/{id}", name="parcial_show")
     * @Method("GET")
     */
    public function showAction(Parcial $parcial)
    {
        $deleteForm = $this->createDeleteForm($parcial);

        return $this->render('parcial/show.html.twig', array(
            'parcial' => $parcial,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Parcial entity.
     *
     * @Route("/{id}/edit", name="parcial_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Parcial $parcial)
    {
        if (esSecretario($this)) {
            $deleteForm = $this->createDeleteForm($parcial);
            $editForm = $this->createForm('AppBundle\Form\ParcialType', $parcial);
            $editForm->handleRequest($request);

            if ($editForm->isSubmitted() && $editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($parcial);
                $em->flush();

                return $this->redirectToRoute('parcial_index', array('idCursada' => $parcial->getCursada()->getId()));
            }

            if (isset($_GET['tieneInstancias']))
                $result=true;
            else
                $result=false;

            return $this->render('parcial/edit.html.twig', array(
                'parcial' => $parcial,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
                'idCursada' => $parcial->getCursada()->getId(),
                'tieneInstancias'=>$result
            ));
        }else{
            $secretario=false;

            $em = $this->getDoctrine()->getManager();
            $catedra = getIdCatedra($this,$em);

            $cursos = $em->getRepository('AppBundle:Cursos')->findByIdcatedra($catedra);
            $nombreCatedra = $em->getRepository('AppBundle:Catedras')->findOneById($catedra);
            return $this->render('cursos/index.html.twig', array(
                'cursos' => $cursos, 'secretario' => $secretario,
            'nombreCatedra' => $nombreCatedra));
        }
    }

    /**
     * Deletes a Parcial entity.
     *
     * @Route("/{id}", name="parcial_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Parcial $parcial)
    {
        $form = $this->createDeleteForm($parcial);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $tieneInstancias=$em->getRepository('AppBundle:InstanciaParcial')->findOneByParcial($parcial->getId());

        if ($form->isSubmitted() && $form->isValid() && empty($tieneInstancias)) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($parcial);
            $em->flush();
        }else{
            return $this->redirectToRoute('parcial_edit', array('id' => $parcial->getId(), 'tieneInstancias'=>'algo'));
        }

        return $this->redirectToRoute('parcial_index', array('idCursada' => $parcial->getCursada()->getId(), 'tieneInstancias'=>'algo'));
    }

    /**
     * Creates a form to delete a Parcial entity.
     *
     * @param Parcial $parcial The Parcial entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Parcial $parcial)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('parcial_delete', array('id' => $parcial->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
