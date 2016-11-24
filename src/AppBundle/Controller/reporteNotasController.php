<?php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\ReporteNotas;
//use AppBundle\Form\ComisionesType;

/**
 * reporteAsistencia controller.
 *
 * @Route("/reporteNotas")
 */
class reporteNotasController extends Controller
{
    /**
     * Lists all  entities.
     *
     * @Route("/", name="reporteNotas_index")
     * @Method("GET")
     */
    public function indexAction()
    {
      $em = $this->getDoctrine()->getManager();
      if (isset($_GET['curso'])) {
         //mostrar todas las notas de los parciales de todas las comisiones
         $id=$_GET['curso'];
         $idCurso=$_GET['curso'];
      }elseif (isset($_GET['comision'])) {
        //mostrar todas las notas de los parciales de una comision
          $id=$_GET['comision'];

                      //BUSCA POR UNA COMISION EN PARTICULAR
            $comision = $em->getRepository('AppBundle:Comisiones')->findOneById($_GET['comision']);

            $curso = $comision->getIdcurso();
             $alumnos = $comision->getAlumnos();
           //   var_dump($id);die();
            $cursos = $em->getRepository('AppBundle:Cursos')->findOneById($curso);
            $parciales = $cursos->getParciales();

            //var_dump($parciales);die();

            $parcial_alumno= array();
            $alumno_parciales=array();
            $notas = array();
             foreach ($parciales as $par) {
                  $parcial = $em->getRepository('AppBundle:Parcial')->findOneById($par->getId());
                  $instancias= $parcial->getInstancias();
                foreach ($instancias as $instancia) {
                   $array_inst [] = array('inst'=>$instancia->getNombre());
                }

                $array_parcial_instancia [] =array('parcial'=>$par,'instancia'=>$array_inst);
                $array_inst="";
             }
            foreach ($alumnos as $alumno) {
                $alumno = $alumno->getIdAlumno();

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
               $alumno_parciales[] = (array('alumno'=>$alumno,'curso'=>$curso,'comision'=>$comision,'parcial_alumno'=>$parcial_alumno));
               $parcial_alumno="";
               $titulo=$comision->getNombre();
            }
            
            $idComision=$_GET['comision'];
      }

            if (isset($idCurso)) {
              $idComision='';
            }else{
              $idCurso='';
            }

            return $this->render('reporteNotas/index.html.twig', array(
                'alumno_parciales' => $alumno_parciales, 'instancias' => $instancias, "parciales" => $parciales,'array_parcial_instancia'=>$array_parcial_instancia,'titulo'=>$titulo,'cursada'=>$idCurso,'comision'=>$idComision
            ));

    }

 
}
