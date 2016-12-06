<?php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\ReporteNotas;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
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
      $instancias = '';
      $array_parcial_instancia = '';
      if (isset($_GET['curso'])) {
         //mostrar todas las notas de los parciales de todas las comisiones
         
         $idCurso=$_GET['curso'];

            //BUSCA POR UNA COMISION EN PARTICULAR
            $cursos = $em->getRepository('AppBundle:Cursos')->findOneById($_GET['curso']);
            $comisiones= $cursos->getComisiones();          
            $parciales = $cursos->getParciales();

            //var_dump($parciales);die();
             foreach ($parciales as $par) {
                  $parcial = $em->getRepository('AppBundle:Parcial')->findOneById($par->getId());
                  $instancias= $parcial->getInstancias();
                foreach ($instancias as $instancia) {
                   $array_inst [] = array('inst'=>$instancia->getNombre());
                }

                $array_parcial_instancia [] =array('parcial'=>$par,'instancia'=>$array_inst);
                $array_inst="";
             } 


            $parcial_alumno= array();
            $alumno_parciales=array();
            $notas = array();    
      foreach ($comisiones as $comi) {
            $comision = $em->getRepository('AppBundle:Comisiones')->findOneById($comi->getId());
             $alumnos = $comision->getAlumnos();
             $curso = $comision->getIdcurso();
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
               $titulo=$curso->getNombre();
            }
             }
            
            
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

  /**
  * @Route("/exportar/excelNotas", name="exportarExcelNotas")
  * @Method("GET")
  */
  public function exportarExcelNotas(Request $request)
      {
          $em = $this->getDoctrine()->getManager();

   if (isset($_GET['comision']) or isset($_GET['curso'])) {
              // recuperamos los elementos de base de datos que queremos exportar
          $query = $em->getRepository('AppBundle:Alumnos')
              ->createQueryBuilder('e')
              ->getQuery();

          $result = $query->getResult();

          if(isset($_GET['comision'])){  
              $comision = $em->getRepository('AppBundle:Comisiones')->findOneById($_GET['comision']);

              $curso = $comision->getIdcurso();
               $alumnos = $comision->getAlumnos();
               $cursos = $em->getRepository('AppBundle:Cursos')->findOneById($curso);
          }elseif (isset($_GET['curso'])) {
              $alumnos = $em->getRepository('AppBundle:Inscriptos')->findByIdcurso($_GET['curso']);
              $cursos = $em->getRepository('AppBundle:Cursos')->findOneById($_GET['curso']);
              //$alumnos = $em->getRepository('AppBundle:Alumnos')->findBy($inscriptos/>getIdAlumno());
          }
           //   var_dump($id);die();
            
            $parciales = $cursos->getParciales();

          // solicitamos el servicio 'phpexcel' y creamos el objeto vacío...
          $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject();

          // ...y le asignamos una serie de propiedades
          $phpExcelObject->getProperties()
              ->setCreator("Grupo3")
              ->setLastModifiedBy("Grupo3")
              ->setTitle("Exportacion de notas por comision")
              ->setSubject("Notas")
              ->setDescription("Listado de Notas por comision.")
              ->setKeywords("vabadus exportar excel ejemplo");

          // establecemos como hoja activa la primera, y le asignamos un título
          $phpExcelObject->setActiveSheetIndex(0);
          $phpExcelObject->getActiveSheet()->setTitle('Notas');
          
          // escribimos en distintas celdas del documento el título de los campos que vamos a exportar

          $phpExcelObject->setActiveSheetIndex(0)
          ->setCellValue('B1', $cursos->getNombre())
          ->setCellValue('B2', 'Nombre y Apellido');
          if(isset($_GET['comision'])){
            $phpExcelObject->setActiveSheetIndex(0)->setCellValue('C1',  $comision->getNombre());
          }
              
            $address = 'B2';
            $address2 = 'B3';
            foreach ($parciales as $parcial) {
                $first = $address[0];
                $first = ++$first;
                $address = $first.$address[1];
                $phpExcelObject->setActiveSheetIndex(0)->setCellValue($address, $parcial->getNombre());

                $instancias= $parcial->getInstancias();
                foreach ($instancias as $instancia) {
                  $first = $address2[0];
                  $first = ++$first;
                  $address2 = $first.$address2[1];

                  $first = $address2[0];
                  $second = $address2[1];
                  $second--;
                  $address = $first.$second;

                  $phpExcelObject->setActiveSheetIndex(0)->setCellValue($address2, $instancia->getNombre());
                }
             }
              if (isset($_GET['curso'])) {
                $first = $address[0];
                $first = ++$first;
                $address = $first.$address[1];
              $phpExcelObject->setActiveSheetIndex(0)->setCellValue($address, 'Comision');
              }

          // fijamos un ancho a las distintas columnas
          $phpExcelObject->setActiveSheetIndex(0)
              ->getColumnDimension('B')
              ->setWidth(30);
          $phpExcelObject->setActiveSheetIndex(0)
              ->getColumnDimension('C')
              ->setWidth(25);
          $phpExcelObject->setActiveSheetIndex(0)
              ->getColumnDimension('D')
              ->setWidth(15);
          $phpExcelObject->setActiveSheetIndex(0)
              ->getColumnDimension('E')
              ->setWidth(20);

            $parcial_alumno= array();
            $alumno_parciales=array();
            $notas = array();
            foreach ($alumnos as $alumno) {
              if (isset($_GET['curso'])) {
                    $comision = $alumno->getIdComision()->getNombre();
                  }
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
                                          "nota"=>"n/a", 
                                          "observacion"=> "n/a",
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
                   }
                   
                   $parcial_alumno[] = (array('parcial'=>$par,'instancia_parcial'=>$notas));
                   $notas="";
                 
                  }
               $alumno_parciales[] = (array('alumno'=>$alumno,'curso'=>$cursos,'comision'=>$comision,'parcial_alumno'=>$parcial_alumno));
               $parcial_alumno="";
          }

          // recorremos los registros obtenidos de la consulta a base de datos escribiéndolos en las celdas correspondientes
          $row = 4;
          foreach ($alumno_parciales as $item) {
              $phpExcelObject->setActiveSheetIndex(0)
                  ->setCellValue('B'.$row, $item['alumno']->getApellido().', '.$item['alumno']->getNombre());
                  $address='C';
                foreach ($item['parcial_alumno'] as $item1) {
                    foreach ($item1['instancia_parcial'] as $item2) {
                        $phpExcelObject->setActiveSheetIndex(0)
                        ->setCellValue($address.$row, $item2['estado'])
                        ->setCellValue($address.++$row, $item2['condicion'])
                        ->setCellValue($address.++$row, $item2['nota'])
                        ->setCellValue($address.++$row, $item2['observacion']);
                          $address++;
                          $row=$row-3;
                     }
                     
                }
                if (isset($_GET['curso'])) {
                  $phpExcelObject->setActiveSheetIndex(0)
                  ->setCellValue($address++.$row, $item['comision']);
                }

              $row=$row+4;
          }

          // se crea el writer
          $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel5');
          // se crea el response
          $response = $this->get('phpexcel')->createStreamedResponse($writer);
          // y por último se añaden las cabeceras
          $dispositionHeader = $response->headers->makeDisposition(
              ResponseHeaderBag::DISPOSITION_ATTACHMENT,
              'reporteNotas.xls'
          );
          $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
          $response->headers->set('Pragma', 'public');
          $response->headers->set('Cache-Control', 'maxage=1');
          $response->headers->set('Content-Disposition', $dispositionHeader);

          return $response;
          }
      }

 
}
