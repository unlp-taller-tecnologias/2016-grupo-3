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

        if(isset($_GET['idInstanciaP'])){ 

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
                                "id"=>"0" )
                                );
                } else { 
                    $notas[] = (array(
                                "alumno"=>$alumno,
                                "nota"=>$nota[0]->getNota(),
                                "condicion"=>$nota[0]->getCondicion(),
                                "observacion"=>$nota[0]->getObservacion(),
                                "estado"=>$nota[0]->getEstado(),
                                "id"=>$asistencia[0]->getId())
                                );
                }
            }
            $instancia = $em->getRepository('AppBundle:InstanciaParcial')->findOneById($_GET['idInstanciaP']);
            return $this->render('alumnosparcial/index.html.twig', array(
                'notas' => $notas, 'instancia' => $instancia, "idComision" => $_GET['idComision']
            ));
        } else {
            return $this->render('error/error.html.twig');
        }
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
