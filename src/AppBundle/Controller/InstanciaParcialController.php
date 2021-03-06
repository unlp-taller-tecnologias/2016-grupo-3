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

        if(isset($_GET['idParcial'])) $idParcial = $_GET['idParcial'];
        else $idParcial = 0;

        if (isset($catedra)) {    
            $parcial = $em->getRepository('AppBundle:Parcial')->findOneById($idParcial);
             if (isset($parcial)) {
                $curso = $parcial->getCursada();
                if ( $curso->getIdcatedra()->getId() == $catedra ){
                           $instanciaParcials = $em->getRepository('AppBundle:InstanciaParcial')->findByParcial($idParcial);
                       } else $instanciaParcials = '';
            } else $instanciaParcials = '';   
        } else $instanciaParcials = '';

        if (isset($_GET['idComision'])) {
            return $this->render('instanciaparcial/indexNotas.html.twig', array(
                'instanciaParcials' => $instanciaParcials, 'parcial' => $idParcial, 'idComision' => $_GET['idComision']
                ));
        }else{

            $idCursada = $em->getRepository('AppBundle:Parcial')->findOneById($idParcial)->getCursada()->getId();
            
            return $this->render('instanciaparcial/index.html.twig', array(
                'instanciaParcials' => $instanciaParcials,
                'secretario' => $secretario,
                'parcial' => $idParcial,
                'cursada' => $idCursada
            ));
        }
        
    }

    /**
     * Updates a group of InstanciaParcial entity.
     *
     * @Route("/update", name="instanciaparcial_update")
     * @Method({"POST"})
     */
    public function updateAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $catedra = getIdCatedra($this,$em);

        if (esSecretario($this)) {
            $secretario=true;
        }else{
            $secretario=false;
        }

        if(isset($_POST['idParcial'])) $idParcial = $_POST['idParcial'];
        else $idParcial = 0;

        if (isset($_POST['estado'])) {
            $estados = $_POST['estado'];
            $idsInstancias = $_POST['idInstanciaP'];

            foreach ($idsInstancias as $idInstancia) { 
                $instancia = $em->getRepository('AppBundle:InstanciaParcial')->findOneById($idInstancia);
                $instancia->setEstado($estados[$idInstancia]);
                $em->persist($instancia);
            }
            $em->flush();
        }
        
        if (isset($catedra)) {    
            $parcial = $em->getRepository('AppBundle:Parcial')->findOneById($idParcial);
             if (isset($parcial)) {
                $curso = $parcial->getCursada();
                if ( $curso->getIdcatedra()->getId() == $catedra ){
                           $instanciaParcials = $em->getRepository('AppBundle:InstanciaParcial')->findByParcial($idParcial);
                       } else $instanciaParcials = '';
            } else $instanciaParcials = '';   
        } else $instanciaParcials = '';

        $idCursada = $em->getRepository('AppBundle:Parcial')->findOneById($idParcial)->getCursada()->getId();
        return $this->render('instanciaparcial/index.html.twig', array(
            'instanciaParcials' => $instanciaParcials,
            'secretario' => $secretario,
            'parcial' => $idParcial,
            'cursada' => $idCursada
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
        if (esSecretario($this)) {
            $instanciaParcial = new InstanciaParcial();
            $form = $this->createForm('AppBundle\Form\InstanciaParcialType', $instanciaParcial);
            $form->handleRequest($request);
            if(isset($_GET['idParcial'])) $idParcial = $_GET['idParcial'];
            else $idParcial = 0;
            if ($form->isSubmitted() && $form->isValid() && $idParcial != 0) {
                
                $fechaFin=$instanciaParcial->getFechaFin();
                if (!isset($fechaFin)) {
                    $instanciaParcial->setFechaFin($instanciaParcial->getFechaInicio());
                }

                $em = $this->getDoctrine()->getManager();
                $catedra = getIdCatedra($this,$em); //buscamos la catedra del usuario activo
                $instanciaParcial->setParcial($em->getRepository('AppBundle:Parcial')->findOneById($idParcial));
                $em->persist($instanciaParcial);
                $em->flush();

                return $this->redirectToRoute('instanciaparcial_index', array('idParcial' => $_GET['idParcial']));
            }

            return $this->render('instanciaparcial/new.html.twig', array(
                'instanciaParcial' => $instanciaParcial,
                'form' => $form->createView(),
                'parcial' => $idParcial
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
        if (esSecretario($this)) {
            $deleteForm = $this->createDeleteForm($instanciaParcial);
            $editForm = $this->createForm('AppBundle\Form\InstanciaParcialType', $instanciaParcial);
            $editForm->handleRequest($request);

            if ($editForm->isSubmitted() && $editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($instanciaParcial);
                $em->flush();

                return $this->redirectToRoute('instanciaparcial_index', array('idParcial' => $instanciaParcial->getParcial()->getId()));
            }
            if (isset($_GET['tieneNotas']))
                $result=true;
            else
                $result=false;

            return $this->render('instanciaparcial/edit.html.twig', array(
                'instanciaParcial' => $instanciaParcial,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
                'idParcial'=>$instanciaParcial->getParcial()->getId(),
                'tieneNotas'=>$result
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
     * Deletes a InstanciaParcial entity.
     *
     * @Route("/{id}", name="instanciaparcial_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, InstanciaParcial $instanciaParcial)
    {
        $form = $this->createDeleteForm($instanciaParcial);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $tieneNotas=$em->getRepository('AppBundle:AlumnosParcial')->findOneByParciales($instanciaParcial->getId());
        if ($form->isSubmitted() && $form->isValid() && empty($tieneNotas)) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($instanciaParcial);
            $em->flush();
        }else{
            return $this->redirectToRoute('instanciaparcial_edit', array('id' => $instanciaParcial->getId(), 'tieneNotas'=>'algo'));
        }

        return $this->redirectToRoute('instanciaparcial_index', array('idParcial' => $instanciaParcial->getParcial()->getId()));
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
