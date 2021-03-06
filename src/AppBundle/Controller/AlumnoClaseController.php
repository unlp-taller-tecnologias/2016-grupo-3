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
        $catedra = getIdCatedra($this,$em);

        if (isset($catedra)) {
            if(isset($_GET['idClase'])){ 
                $clase = $em->getRepository('AppBundle:Clase')->findOneById($_GET['idClase']);
                $curso = $em->getRepository('AppBundle:Cursos')->findOneById($clase->getCursada()->getId());
                if (isset($curso)) {
                    if ( $curso->getIdcatedra()->getId() == $catedra ){
                        if ($clase->getEstado() != "suspendida") {
                            $comision = $em->getRepository('AppBundle:Comisiones')->findOneById($_GET['idComision']);
                            $curso = $comision->getIdcurso();
                            $alumnos = $comision->getAlumnos();
                            $asistencias = array();
                            foreach ($alumnos as $alumno) {
                                $alumno = $alumno->getIdAlumno();
                                $asistencia = encontrarUnaAsistenciaByAlumnoAndClase($em,$alumno->getId(),$_GET['idClase']);
                                if ($asistencia == null) {
                                    $asistencias[] = (array("alumno"=>$alumno,"asistencia"=>"n/a", "observacion"=> "","id"=>"0" ));
                                } else { 
                                    $asistencias[] = (array("alumno"=>$alumno,"asistencia"=>$asistencia[0]->getEstado(),"observacion"=>$asistencia[0]->getObservacion(),"id"=>$asistencia[0]->getId()));
                                }

                            }
                           
                            return $this->render('alumnoclase/index.html.twig', array(
                                'asistencias' => $asistencias, 'clase' => $clase, "idComision" => $_GET['idComision']
                            ));
                        } else {
                           $idCursada = $em->getRepository('AppBundle:Comisiones')->findOneById($_GET['idComision']);
                            $idCursada = $idCursada->getIdCurso();
                            $idCursada = $idCursada->getId();
                            $clases = $em->getRepository('AppBundle:Clase')->findByCursada($idCursada);
                            return $this->render('clase/indexAsistencias.html.twig', array(
                                'clases' => $clases, 'cursada' => $idCursada, 'idComision' => $_GET['idComision']
                            )); 
                        }
                    } 
                } 
            } 
        }       
        return $this->render('error/error.html.twig');      
    }

    /**
     * Updates a group of AlumnoClase entity.
     *
     * @Route("/update", name="alumnoclase_update")
     * @Method({"POST"})
     */
    public function updateAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $catedra = getIdCatedra($this,$em);

        if (isset($catedra)) {
            if(isset($_POST['idClase'])){ 
                $clase = $em->getRepository('AppBundle:Clase')->findOneById($_POST['idClase']);
                $curso = $em->getRepository('AppBundle:Cursos')->findOneById($clase->getCursada()->getId());
                if (isset($curso)) {
                    if ( $curso->getIdcatedra()->getId() == $catedra ){
                        if ($clase->getEstado() != "suspendida") {
                            $idsAlumno = $_POST['idAlumno'];
                            $clase = $_POST['idClase'];
                            $idsAsistencia = $_POST['idAsistencia'];
                            $estados = $_POST['estado'];
                            $observaciones = $_POST['observacion'];
                            $clase = $em->getRepository('AppBundle:Clase')->findOneById($clase);
                            
                            $clase->setEstado("finalizada");
                            $em->persist($clase);
                            
                            foreach ($idsAlumno as $idAlumno) { 
                                $alumno = $em->getRepository('AppBundle:Alumnos')->findOneById($idAlumno);
                                if ($idsAsistencia[$idAlumno] == 0) {
                                    $alumnoClase = new AlumnoClase();
                                    $alumnoClase->setAlumnos($alumno);
                                    $alumnoClase->setClases($clase);
                                } else {
                                    $alumnoClase = $em->getRepository('AppBundle:AlumnoClase')->findOneById($idsAsistencia[$idAlumno]);
                                }
                                if ($estados[$idAlumno] != 'Seleccionar') {
                                    $alumnoClase->setObservacion($observaciones[$idAlumno]);
                                    $alumnoClase->setEstado($estados[$idAlumno]);
                                    $em->persist($alumnoClase);
                                }
                            }
                            $em->flush();

                            $cursada = $clase->getCursada();
                            $inscripto = encontrarUnInscriptoByAlumnoAndClase($em, $alumno->getId(), $cursada->getId());
                            $comision = $inscripto[0]->getIdcomision()->getId();
                            return $this->redirect($this->generateUrl('clase_index', array('idComision' => $comision)));
                        } 
                    } 
                } 
            } 
        }       
        return $this->render('error/error.html.twig');
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
