<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\AlumnosParcial;
use AppBundle\Form\AlumnosParcialType;

/**
 * AlumnosParcial controller.
 *
 * @Route("/notas")
 */
class AlumnosParcialController extends Controller
{
    /**
     * Lists all AlumnosParcial entities.
     *
     * @Route("/", name="notas_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $catedra = getIdCatedra($this,$em);

        if (isset($catedra)) {
            if(isset($_GET['idInstanciaP'])){
                $instancia = $em->getRepository('AppBundle:InstanciaParcial')->findOneById($_GET['idInstanciaP']);
                $parcial = $em->getRepository('AppBundle:Parcial')->findOneById($instancia->getParcial()->getId());
                if (isset($parcial)) {
                    $curso = $parcial->getCursada();
                    if ( $curso->getIdcatedra()->getId() == $catedra ){
                        if ($instancia->getEstado() != "suspendido") {

                            $comision = $em->getRepository('AppBundle:Comisiones')->findOneById($_GET['idComision']);
                            $curso = $comision->getIdcurso();
                            $alumnos = $comision->getAlumnos();
                            $notas = array();
                            foreach ($alumnos as $alumno) {
                                $alumno = $alumno->getIdAlumno();
                                $nota = encontrarUnaNotaByAlumnoAndInstancia($em,$alumno->getId(),$_GET['idInstanciaP']);
                                if ($nota == null) {
                                    $notas[] = (array(
                                                "alumno"=>$alumno,
                                                "estado"=>"n/a",
                                                "nota"=>"", 
                                                "observacion"=> "",
                                                "condicion"=>"n/a",
                                                "idNota"=>"0" )
                                                );
                                } else { 
                                    $notas[] = (array(
                                                "alumno"=>$alumno,
                                                "nota"=>$nota[0]->getNota(),
                                                "condicion"=>$nota[0]->getCondicion(),
                                                "observacion"=>$nota[0]->getObservacion(),
                                                "estado"=>$nota[0]->getEstado(),
                                                "idNota"=>$nota[0]->getId())
                                                );
                                }
                            }
                            
                            return $this->render('alumnosparcial/index.html.twig', array(
                                'notas' => $notas, 'instancia' => $instancia, "idComision" => $_GET['idComision'], 'idParcial' => $instancia->getParcial()->getId(), 'idCursada' => $curso->getId()
                            ));
                        } else {
                            $instanciaParcials = $em->getRepository('AppBundle:InstanciaParcial')->findByParcial($parcial->getId());
                            return $this->render('instanciaparcial/indexNotas.html.twig', array(
                                'instanciaParcials' => $instanciaParcials, 'parcial' => $parcial->getId(), 'idComision' => $_GET['idComision']
                            ));
                        }
                    }
                }
            }
        }
        return $this->render('error/error.html.twig');
    }

    /**
     * Updates a group of AlumnoParcial entity.
     *
     * @Route("/update", name="alumnosparcial_update")
     * @Method({"POST"})
     */
    public function updateAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $catedra = getIdCatedra($this,$em);

        if (isset($catedra)) {
            if(isset($_POST['idInstanciaP'])){
                $instancia = $em->getRepository('AppBundle:InstanciaParcial')->findOneById($_POST['idInstanciaP']);
                $parcial = $em->getRepository('AppBundle:Parcial')->findOneById($instancia->getParcial()->getId());
                if (isset($parcial)) {
                    $curso = $parcial->getCursada();
                    if ( $curso->getIdcatedra()->getId() == $catedra ){
                        if ($instancia->getEstado() != "suspendido") {

                            $idInstanciaP = $_POST['idInstanciaP'];
                            $idComision = $_POST['idComision'];
                            $idsAlumno = $_POST['idAlumno'];
                            $idsNotas = $_POST['idNota'];
                            $notas = $_POST['nota'];
                            $condiciones = $_POST['condicion'];
                            $estados = $_POST['estado'];
                            $observaciones = $_POST['observacion'];
                            $instanciaParcial = $em->getRepository('AppBundle:InstanciaParcial')->findOneById($idInstanciaP);

                            $instanciaParcial->setEstado("finalizado");
                            $em->persist($instanciaParcial);

                            foreach ($idsAlumno as $idAlumno) { 
                                $alumno = $em->getRepository('AppBundle:Alumnos')->findOneById($idAlumno);
                                if ($idsNotas[$idAlumno] == 0) {
                                    $alumnoParcial = new AlumnosParcial();
                                    $alumnoParcial->setAlumnos($alumno);
                                    $alumnoParcial->setParciales($instanciaParcial);
                                } else {
                                    $alumnoParcial = $em->getRepository('AppBundle:AlumnosParcial')->findOneById($idsNotas[$idAlumno]);
                                }
                                if (($estados[$idAlumno] != 'Seleccionar')OR($condiciones[$idAlumno] != 'Seleccionar')) {
                                    $alumnoParcial->setNota($notas[$idAlumno]);
                                    $alumnoParcial->setObservacion($observaciones[$idAlumno]);
                                    $alumnoParcial->setEstado($estados[$idAlumno]);
                                    $alumnoParcial->setCondicion($condiciones[$idAlumno]);
                                    $em->persist($alumnoParcial);
                                }
                            }
                            $em->flush();
                            $comision = $em->getRepository('AppBundle:Comisiones')->findOneById($idComision);
                            $cursada = $comision->getIdcurso();
                            return $this->redirect($this->generateUrl('instanciaparcial_index', array('idParcial' => $instanciaParcial->getParcial()->getId(), 'idComision' => $idComision, 'idCursada' => $cursada->getId())));
                        } 
                    } 
                } 
            } 
        }       
        return $this->render('error/error.html.twig');
    }

    /**
     * Creates a new AlumnosParcial entity.
     *
     * @Route("/new", name="notas_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $alumnosParcial = new AlumnosParcial();
        $form = $this->createForm('AppBundle\Form\AlumnosParcialType', $alumnosParcial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($alumnosParcial);
            $em->flush();

            return $this->redirectToRoute('notas_show', array('id' => $alumnosParcial->getId()));
        }

        return $this->render('alumnosparcial/new.html.twig', array(
            'alumnosParcial' => $alumnosParcial,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a AlumnosParcial entity.
     *
     * @Route("/{id}", name="notas_show")
     * @Method("GET")
     */
    public function showAction(AlumnosParcial $alumnosParcial)
    {
        $deleteForm = $this->createDeleteForm($alumnosParcial);

        return $this->render('alumnosparcial/show.html.twig', array(
            'alumnosParcial' => $alumnosParcial,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing AlumnosParcial entity.
     *
     * @Route("/{id}/edit", name="notas_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, AlumnosParcial $alumnosParcial)
    {
        $deleteForm = $this->createDeleteForm($alumnosParcial);
        $editForm = $this->createForm('AppBundle\Form\AlumnosParcialType', $alumnosParcial);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($alumnosParcial);
            $em->flush();

            return $this->redirectToRoute('notas_edit', array('id' => $alumnosParcial->getId()));
        }

        return $this->render('alumnosparcial/edit.html.twig', array(
            'alumnosParcial' => $alumnosParcial,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a AlumnosParcial entity.
     *
     * @Route("/{id}", name="notas_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, AlumnosParcial $alumnosParcial)
    {
        $form = $this->createDeleteForm($alumnosParcial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($alumnosParcial);
            $em->flush();
        }

        return $this->redirectToRoute('notas_index');
    }

    /**
     * Creates a form to delete a AlumnosParcial entity.
     *
     * @param AlumnosParcial $alumnosParcial The AlumnosParcial entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(AlumnosParcial $alumnosParcial)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('notas_delete', array('id' => $alumnosParcial->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
