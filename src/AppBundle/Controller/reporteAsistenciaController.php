<?php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\ReporteAsistencia;
//use AppBundle\Form\ComisionesType;

/**
 * reporteAsistencia controller.
 *
 * @Route("/reporteAsistencia")
 */
class reporteAsistenciaController extends Controller
{
    /**
     * Lists all  entities.
     *
     * @Route("/", name="reporteAsistencia_index")
     * @Method("GET")
     */
    public function indexAction()
    {
      $em = $this->getDoctrine()->getManager();
      if (isset($_GET['curso'])) {
        //BUSCA POR UN CURSO EN PARTICULAR
            $id=$_GET['curso'];

           //   var_dump($id);die();
            $cursos = $em->getRepository('AppBundle:Cursos')->findOneById($_GET['curso']);
            $clases = $cursos->getClases();
          
            $comisiones= $cursos->getComisiones();
 
            $asistencias = array();
            $alumnos_asistencia = array();

            foreach ($comisiones as $comi) {

             $comision = $em->getRepository('AppBundle:Comisiones')->findOneById($comi->getId());
             $alumnos = $comision->getAlumnos();

            foreach ($alumnos as $alumno) {
                $alumno = $alumno->getIdAlumno();
                foreach ($clases as $clas) {
                   $asistencia = encontrarUnaAsistenciaByAlumnoAndClase($em,$alumno->getId(),$clas->getId());
                    if ($asistencia == null) {
                    $asistencias[] = (array("clase"=>$clas,"asistencia"=>"n/a", "observacion"=> "asistencia no pasada todavia","id"=>"0" ));
                   } else { 
                    $asistencias[] = (array("clase"=>$clas,"asistencia"=>$asistencia[0]->getEstado(),"observacion"=>$asistencia[0]->getObservacion(),"id"=>$asistencia[0]->getId()));
                   }

                }
               
               $alumnos_asistencia[]=  (array("alumno"=>$alumno,"curso"=>$cursos,"comision"=>$comision,"asistencias"=>$asistencias));  
              $asistencias = "";
            }
           // var_dump($alumnos_asistencia[0]); die();

            }

          $miCurso=$cursos->getId();

   }elseif (isset($_GET['comision'])) {
            //BUSCA POR UNA COMISION EN PARTICULAR
            $id=$_GET['comision'];
            $comision = $em->getRepository('AppBundle:Comisiones')->findOneById($_GET['comision']);

            $curso = $comision->getIdcurso();
             $alumnos = $comision->getAlumnos();
           //   var_dump($id);die();
            $cursos = $em->getRepository('AppBundle:Cursos')->findOneById($curso);
            $clases = $cursos->getClases();
          

            $asistencias = array();
            $alumnos_asistencia = array();
            foreach ($alumnos as $alumno) {
                $alumno = $alumno->getIdAlumno();
                foreach ($clases as $clas) {
                   $asistencia = encontrarUnaAsistenciaByAlumnoAndClase($em,$alumno->getId(),$clas->getId());
                    if ($asistencia == null) {
                    $asistencias[] = (array("clase"=>$clas,"asistencia"=>"n/a", "observacion"=> "asistencia no pasada todavia","id"=>"0" ));
                   } else { 
                    $asistencias[] = (array("clase"=>$clas,"asistencia"=>$asistencia[0]->getEstado(),"observacion"=>$asistencia[0]->getObservacion(),"id"=>$asistencia[0]->getId()));
                   }

                }
               
               $alumnos_asistencia[]=  (array("alumno"=>$alumno,"curso"=>$cursos,"comision"=>$comision,"asistencias"=>$asistencias));  
              $asistencias = "";
            }
           // var_dump($alumnos_asistencia[0]); die();
            $miComision=$_GET['comision'];
         }
    //Este if evita que el sistema se rompa cuando esta en modo desarrollador
    if (isset($miCurso)) {
      $miComision='';
    }else{
      $miCurso='';
    }
    return $this->render('reporteAsistencia/index.html.twig',array('alumnos_asistencia'=>$alumnos_asistencia,"clases"=>$clases, 'idCurso' => $miCurso,'idComision' => $miComision));
  }

 
}
