<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\AlumnoClase;
use AppBundle\Form\AlumnoClaseType;

/**
 * AlumnoClase controller.
 *
 * @Route("/asistencias")
 */
class AlumnoClaseController extends Controller
{
    /**
     * Lists all AlumnoClase entities.
     *
     * @Route("/", name="alumnoclase_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        if(isset($_GET['idClase'])){ 

            $comision = $em->getRepository('AppBundle:Comisiones')->findOneById($_GET['idComision']);
            $curso = $comision->getIdcurso();
            $alumnos = $comision->getAlumnos();
            $asistencias = array();
            foreach ($alumnos as $alumno) {
                $alumno = $alumno->getIdAlumno();
                $asistencia = encontrarUnaAsistenciaByAlumnoAndClase($em,$alumno->getId(),$_GET['idClase']);
                if ($asistencia == null) {
                    $asistencias[] = (array("alumno"=>$alumno,"asistencia"=>"n/a", "observacion"=> "asistencia no pasada todavia" ));
                } else { 
                    $asistencias[] = (array("alumno"=>$alumno,"asistencia"=>$asistencia[0]->getEstado(),"observacion"=>$asistencia[0]->getObservacion()));
                }

            }
           
            $clase = $em->getRepository('AppBundle:Clase')->findOneById($_GET['idClase']);

            return $this->render('alumnoclase/index.html.twig', array(
                'asistencias' => $asistencias, 'clase' => $clase, "idComision" => $_GET['idComision']
            ));
        } else {
            return $this->render('error/error.html.twig');
        }
    }

    /**
     * Creates a new AlumnoClase entity.
     *
     * @Route("/new", name="alumnoclase_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $alumnoClase = new AlumnoClase();
        $form = $this->createForm('AppBundle\Form\AlumnoClaseType', $alumnoClase);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($alumnoClase);
            $em->flush();

            return $this->redirectToRoute('alumnoclase_show', array('id' => $alumnoClase->getId()));
        }

        return $this->render('alumnoclase/new.html.twig', array(
            'alumnoClase' => $alumnoClase,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a AlumnoClase entity.
     *
     * @Route("/{id}", name="alumnoclase_show")
     * @Method("GET")
     */
    public function showAction(AlumnoClase $alumnoClase)
    {
        $deleteForm = $this->createDeleteForm($alumnoClase);

        return $this->render('alumnoclase/show.html.twig', array(
            'alumnoClase' => $alumnoClase,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing AlumnoClase entity.
     *
     * @Route("/{id}/edit", name="alumnoclase_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, AlumnoClase $alumnoClase)
    {
        $deleteForm = $this->createDeleteForm($alumnoClase);
        $editForm = $this->createForm('AppBundle\Form\AlumnoClaseType', $alumnoClase);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($alumnoClase);
            $em->flush();

            return $this->redirectToRoute('alumnoclase_edit', array('id' => $alumnoClase->getId()));
        }

        return $this->render('alumnoClase/edit.html.twig', array(
            'alumnoClase' => $alumnoClase,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a AlumnoClase entity.
     *
     * @Route("/{id}", name="alumnoclase_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, AlumnoClase $alumnoClase)
    {
        $form = $this->createDeleteForm($alumnoClase);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($alumnoClase);
            $em->flush();
        }

        return $this->redirectToRoute('alumnoclase_index');
    }

    /**
     * Creates a form to delete a AlumnoClase entity.
     *
     * @param AlumnoClase $alumnoClase The AlumnoClase entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(AlumnoClase $alumnoClase)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('alumnoclase_delete', array('id' => $alumnoClase->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
