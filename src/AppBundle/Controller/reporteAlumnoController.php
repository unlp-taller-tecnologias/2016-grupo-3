<?php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\ReporteAlumno;
//use AppBundle\Form\ComisionesType;

/**
 * reporteAlumno controller.
 *
 * @Route("/reporteAlumno")
 */
class reporteAlumnoController extends Controller
{
    /**
     * Lists all  entities.
     *
     * @Route("/", name="reporteAlumno_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        
         $em = $this->getDoctrine()->getManager();


         //DATOS DEL ALUMNO
         $alumno = $em->getRepository('AppBundle:Alumnos')->findOneById($_GET['idAlumno']);
         var_dump($alumno->getId());
        $comision = $em->getRepository('AppBundle:Comisiones')->findOneById($_GET['idComision']);
        //OTRAS COMISIONES
        $otras_comisiones=encontrarAlumnoEnCursosAnteriores($em,$$_GET['idAlumno'],$_GET['idCursada']);
        //var_dump($otras_comisiones); die();
         //LASES DEL ALUMNO
         $titulo=$alumno->getApellido();
         $titulo .=", ".$alumno->getNombre();
         $cursos = $em->getRepository('AppBundle:Cursos')->findOneById($_GET['idCursada']);
         $clases = $cursos->getClases();
         $cant_presentes=0;
         $cant_clases_tomadas=0; 
          foreach ($clases as $clas) {
                    if ($clas->getEstado() == "finalizada") {
                      if ($clas->getRequerida() == 1) {
                         $cant_clases_tomadas=$cant_clases_tomadas + 1;
                      }
                     
                    }
                   $asistencia = encontrarUnaAsistenciaByAlumnoAndClase($em,$alumno->getId(),$clas->getId());
                    if ($asistencia == null) {
                        
                   } else { 
                    if ($asistencia[0]->getEstado() == "presente" or $asistencia[0]->getEstado() == "justificado") {
                      $cant_presentes=$cant_presentes + 1;
                    }
                    
                   }

                }
                $clases_alumno= array("clases"=>$clases,"cant_clases_tomadas"=>$cant_clases_tomadas,"cant_presentes"=>$cant_presentes);

         //NOTAS DEL ALUMNO
            $cursos = $em->getRepository('AppBundle:Cursos')->findOneById($_GET['idCursada']);
            $parciales = $cursos->getParciales();

          foreach ($parciales as $par) {
                  $parcial = $em->getRepository('AppBundle:Parcial')->findOneById($par->getId());
                  $instancias= $parcial->getInstancias();
                foreach ($instancias as $instancia) {
                   $array_inst [] = array('inst'=>$instancia->getNombre());
                }

                $array_parcial_instancia [] =array('parcial'=>$par,'instancia'=>$array_inst);
                $array_inst="";
             }

                  foreach ($parciales as $par) {
                    //recorro todos los parciales y voy trayendolos por el id
                      $parcial = $em->getRepository('AppBundle:Parcial')->findOneById($par->getId());
                      $instancias= $parcial->getInstancias();
                   foreach ($instancias as $instancia) {
                        //recorro todas las instancias de un parcial
                          $nota = encontrarUnaNotaByAlumnoAndInstancia($em,$alumno->getId(),$instancia->getId());
                          if ($nota == null) {
                              $notas[] = (array(
                                          "instancia"=>$instancia,
                                          "estado"=>"n/a",
                                          "nota"=>"", 
                                          "observacion"=> "",
                                          "condicion"=>"n/a",
                                          "idNota"=>"0" )
                                          );
                          } else { 
                              $notas[] = (array(
                                          "instancia"=>$instancia,
                                          "nota"=>$nota[0]->getNota(),
                                          "condicion"=>$nota[0]->getCondicion(),
                                          "observacion"=>$nota[0]->getObservacion(),
                                          "estado"=>$nota[0]->getEstado(),
                                          "idNota"=>$nota[0]->getId())
                                          );
                          }
                          //$instancia_parcial[] = (array('instancia'=>$instancia,'notas'=>$notas));
                         // $notas="";
                        //$instancia = $em->getRepository('AppBundle:InstanciaParcial')->findOneById($_GET['idInstanciaP']);
                   }
                   
                   $parcial_alumno[] = (array('parcial'=>$par,'instancia_parcial'=>$notas));
                   $notas="";
                 
                  }

       $idCurso= $_GET['idCursada'];
         //OTRAS CURSADAS DE LA MISMA CATEDRA EN LA QUE PARTICIPO

         return $this->render('reporteAlumno/index.html.twig',array('titulo'=>$titulo,'alumno'=>$alumno,'comision'=>$comision,'clases_alumno'=>$clases_alumno,'parcial_alumno'=>$parcial_alumno,'array_parcial_instancia'=>$array_parcial_instancia,'otras_comisiones'=>$otras_comisiones,'idCurso'=>$idCurso));
    }

 
}
